class teachersOverview {

    selectedTeacher = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;

        $(function () {
            self.setDeleteButtonEvent(self);
            self.setEditButtonEvent(self);
        });
    }

    setDeleteButtonEvent(self) {
        $('.deleteTeacherButton').on('click', function () {
            self.selectedTeacher = $(this).data('teacherid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitDeleteTeacher);
        });
    }

    submitDeleteTeacher(self, newModal) {
        let teacherId = self.selectedTeacher;

        $(newModal).find('.submitButton').on('click', function () {
            $.ajax({
                url: '/teacher/' + teacherId,
                type: 'DELETE',
                success: function () {
                    window.location.reload();
                }
            });
        });
    }

    setEditButtonEvent(self) {
        $('.editTeacherButton').on('click', function () {
            self.selectedTeacher = $(this).data('teacherid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitEditTeacher, self.selectedTeacher);
        });
    }

    submitEditTeacher(self, newModal) {
        let teacherId = self.selectedTeacher;

    }


}

new teachersOverview();
