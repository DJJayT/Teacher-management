class trainingOverview {

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
        $('.editTrainingButton').on('click', function () {
            let selectedTraining = $(this).data('trainingid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitEditTraining, selectedTraining);
        });
    }

    submitEditTraining(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#trainingForm').submit();
        });
    }

    setCreateButtonEvent(self) {
        $('.createTrainingButton').on('click', function () {
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitCreateTraining);
        });
    }

    submitCreateTraining(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#trainingForm').submit();
        });
    }


}

new trainingOverview();
