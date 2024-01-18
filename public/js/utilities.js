class utilities {

    static postAjax(url, data, successCallback, callbackObject, errorCallback = null) {
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                successCallback(response, callbackObject);
            },
            error: function (response) {
                if (errorCallback !== null) {
                    errorCallback(response, callbackObject);
                } else {
                    modal.showErrorModal(response);
                }
            }
        });
    }

    static getAjax(url, successCallback, callbackObject, errorCallback = null) {
        $.ajax({
            type: "GET",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                successCallback(response, callbackObject);
            },
            error: function (response) {
                if (errorCallback !== null) {
                    errorCallback(response, callbackObject);
                } else {
                    modal.showErrorModal(response);
                }
            }
        });
    }

    static deleteAjax(url, successCallback, callbackObject, errorCallback = null) {
        $.ajax({
            type: "DELETE",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                successCallback(response, callbackObject);
            },
            error: function (response) {
                if (errorCallback !== null) {
                    errorCallback(response, callbackObject);
                } else {
                    modal.showErrorModal(response);
                }
            }
        });
    }

    static sleep(milliseconds) {
        return new Promise(resolve => setTimeout(resolve, milliseconds));
    }

}
