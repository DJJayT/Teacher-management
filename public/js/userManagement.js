class userManagement {

    userId = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;

        $(function () {
            self.setEditButtonEvent(self);
            self.setCreateButtonEvent(self);
            self.setDeleteButtonEvent(self);
        });
    }

    setEditButtonEvent(self) {
        $('.editUserButton').on('click', function () {
            let selectedUser = $(this).data('userid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitEditUser, selectedUser);
        });
    }

    submitEditUser(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#userForm').submit();
        });
    }

    setCreateButtonEvent(self) {
        $('.createUserButton').on('click', function () {
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitCreateUser);
        });
    }

    submitCreateUser(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#userForm').submit();
        });
    }

    setDeleteButtonEvent(self) {
        $('.deleteUserButton').on('click', function () {
            self.userId = $(this).data('userid');
            let modalId = $(this).data('modalid');

            modal.getModal(modalId, self, self.submitDeleteUser);
        });
    }

    submitDeleteUser(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            window.location.href = '/user/' + self.userId + '/delete';
        });
    }


}

new userManagement();
