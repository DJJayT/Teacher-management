class teachersOverview {

    selectedTeacher = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;

        $(function () {
            self.setEditButtonEvent(self);
            self.setCreateButtonEvent(self);
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


}

new teachersOverview();
