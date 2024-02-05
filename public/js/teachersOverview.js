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

    getTeachersOverview(self, onlyActive = true) {
        utilities.postAjax('/teachers/getOverview', {onlyActive: onlyActive}, self.setTeachersOverview, self)
    }

    setTeachersOverview(response, self) {
        $('.showActiveButton').prop('disabled', false);
        $('.teachersOverview').html(response);
        self.setEditButtonEvent(self);
    }


}

new teachersOverview();
