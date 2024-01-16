class modal {

    static self = null;

    static getModal(modalId, callbackObject, callbackFunction = function () {
    }, additionalId = 0) {
        if (modal.self === null) {
            modal.self = new modal();
        }

        if (additionalId !== 0) {
            modalId += '/' + additionalId;
        }

        modal.self.ajax('/getModal/' + modalId, callbackObject, callbackFunction);
    }

    static showModalContent(data, callbackFunction, callbackObject) {
        console.log("kommt")
        let modalData = data.modal;
        let newModal = $('#basePopup').clone().appendTo('body')[0];

        $(newModal).find('.modal-title').text(modalData.title);
        $(newModal).find('.modal-body').html(modalData.body);

        console.log(modalData)

        if (modalData.successHide === true) {
            $(newModal).find('.submitButton').hide();
        }

        if (modalData.successText !== undefined) {
            $(newModal).find('.submitButton').text(modalData.successText);
        }

        if (modalData.closeHide === true) {
            $(newModal).find('.closeButton').hide();
        }

        if (modalData.closeText !== undefined) {
            $(newModal).find('.closeButton').text(modalData.closeText);
        }


        $(newModal).find('.closeButton').on('click', function () {
            $(newModal).modal('hide');
        });

        callbackFunction(callbackObject, newModal);

        $(newModal).modal('show');
        $(newModal).on('hidden.bs.modal', function () {
            $(this).remove();
        });
    }

    static showErrorModal(error) {
        let errorMessage = error.responseJSON.message;

        let modalData = {
            title: 'Error',
            body: errorMessage,
            successHide: true,
            closeText: 'Close'
        };

        modal.showModalContent({modal: modalData}, function () {
        }, function () {
        });
    }

    ajax(url, callbackObject, callbackFunction = function () {
    }) {
        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                modal.showModalContent(response, callbackFunction, callbackObject);
            },
            error: function (response) {
                modal.showErrorModal(response.responseText);
            }
        });
    }
}
