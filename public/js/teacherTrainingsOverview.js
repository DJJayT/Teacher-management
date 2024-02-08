class teacherTrainingsOverview {

    teacherId = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;
        $(function () {
            self.setPaginationButtonsEvent(self);
            self.getTeacherId(self);
            self.setEditButtonEvent(self);
            self.setCreateButtonEvent(self);
        });
    }

    setPaginationButtonsEvent(self) {
        $('.page-item').on('click', function () {
            let pageId = $(this).find('.page-link').data('pageid');

            if (pageId !== undefined) {
                self.getTrainingsOverview(self, pageId);
            }
        });
    }

    getTrainingsOverview(self, pageId = 1) {
        let url = '/teacher/' + self.teacherId + '/getTrainingsOverview';
        utilities.postAjax(url, {page: pageId}, self.setTrainingsOverview, self)
    }

    setTrainingsOverview(response, self) {
        $('.teacherTrainingsOverview').html(response);
        self.setEditButtonEvent(self);
        self.setPaginationButtonsEvent(self);
    }

    getTeacherId(self) {
        self.teacherId = $('meta[name="teacher_id"]').attr('content')
    }

    setEditButtonEvent(self) {
        $('.editTeacherTrainingButton').on('click', function () {
            let modalId = $(this).data('modalid');
            let trainingId = $(this).data('trainingid');

            modal.getModal(modalId, self, self.submitEditTeacherTraining, trainingId);
        });
    }

    submitEditTeacherTraining(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#teacherTrainingsForm').submit();
        });
    }

    setCreateButtonEvent(self) {
        $('.createTeacherTrainingButton').on('click', function () {
            let modalId = $(this).data('modalid');
            let teacherId = $(this).data('teacherid');

            modal.getModal(modalId, self, self.submitCreateTeacherTraining, teacherId);
        });
    }

    submitCreateTeacherTraining(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#teacherTrainingsForm').submit();
        });
    }


}

new teacherTrainingsOverview();
