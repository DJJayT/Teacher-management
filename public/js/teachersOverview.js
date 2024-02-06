class teachersOverview {

    constructor() {
        this.init();
    }

    init() {
        let self = this;

        $(function () {
            self.setEditButtonEvent(self);
            self.setCreateButtonEvent(self);
            self.setShowActiveButtonEvent(self);
            self.setPaginationButtonsEvent(self);
        });
    }

    setEditButtonEvent(self) {
        $('.editTeacherButton').on('click', function () {
            let selectedTeacher = $(this).data('teacherid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitEditTeacher, selectedTeacher);
        });
    }

    submitEditTeacher(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#teacherForm').submit();
        });
    }

    setCreateButtonEvent(self) {
        $('.createTeacherButton').on('click', function () {
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitCreateTeacher);
        });
    }

    submitCreateTeacher(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#teacherForm').submit();
        });
    }

    setShowActiveButtonEvent(self) {
        $('.showActiveButton').on('click', function () {
            if($(this).find('i').hasClass('bi-check-circle-fill')) {
                $(this).prop('disabled', true);

                console.log($(this).find('i'));
                $(this).find('i').removeClass('bi-check-circle-fill');
                $(this).find('i').addClass('bi-circle');
                self.getTeachersOverview(self, false)
            } else {
                $(this).prop('disabled', true);

                $(this).find('i').removeClass('bi-circle');
                $(this).find('i').addClass('bi-check-circle-fill');
                self.getTeachersOverview(self)
            }
        });
    }

    getTeachersOverview(self, onlyActive = true, pageId = 1) {
        utilities.postAjax('/teachers/getOverview', {onlyActive: onlyActive, page: pageId}, self.setTeachersOverview, self)
    }

    setTeachersOverview(response, self) {
        $('.showActiveButton').prop('disabled', false);
        $('.teachersOverview').html(response);
        self.setEditButtonEvent(self);
        self.setPaginationButtonsEvent(self);
    }

    setPaginationButtonsEvent(self) {
        $('.page-item').on('click', function () {
            let pageId = $(this).find('.page-link').data('pageid');
            let onlyActive = $('.showActiveButton').find('i').hasClass('bi-check-circle-fill');

            if(pageId !== undefined) {
                self.getTeachersOverview(self, onlyActive, pageId);
            }
        });
    }


}

new teachersOverview();
