class absencesOverview {

    teacherId = null;
    sickDayId = null;
    offDutyDayId = null;
    month = null;
    year = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;
        $(function () {
            self.setCalendarEvent(self);
            self.getTeacherId(self);
            self.setListEvents(self);
        });
    }

    setListEvents(self) {
        self.setSickDaysPaginationButtonsEvent(self);
        self.setOffDutyPaginationButtonsEvent(self);
        self.setSickDayCreateButtonEvent(self);
        self.setSickDayDeleteButtonEvent(self);
        self.setSickDayEditButtonEvent(self);
        self.setOffDutyDayCreateButtonEvent(self);
        self.setOffDutyDayDeleteButtonEvent(self);
        self.setOffDutyDayEditButtonEvent(self);
    }

    setCalendarEvent(self) {
        jSuites.calendar(document.getElementById('calendar'), {
            type: 'year-month-picker',
            format: 'MMM-YYYY',
            validRange: ['2000-01-01', '2100-12-12'],
            readonly: false,

            onchange: function (instance, value) {
                let splittedValue = value.split('-');
                self.month = splittedValue[1];
                self.year = splittedValue[0];

                let url = '/teacher/' + self.teacherId + '/absences/' + self.year + '/' + self.month;

                console.log(url)

                utilities.postAjax(url, {}, function (success) {
                    $('.absencesList').html(success);
                    self.setListEvents(self);
                    console.log(success)
                }, self);

            }
        });
    }

    getTeacherId(self) {
        self.teacherId = $('meta[name="teacher_id"]').attr('content')
    }

    setSickDaysPaginationButtonsEvent(self) {
        $('.sickDayList').find('.page-item').on('click', function () {
            let pageId = $(this).find('.page-link').data('pageid');

            if (pageId !== undefined) {
                let data = {
                    page: pageId,
                    year: self.year,
                    month: self.month
                }

                console.log(data)
                self.getSickDaysOverview(self, data);
                console.log(pageId)
            }
        });
    }

    setOffDutyPaginationButtonsEvent(self) {
        $('.offDutyList').find('.page-item').on('click', function () {
            let pageId = $(this).find('.page-link').data('pageid');

            if (pageId !== undefined) {
                let data = {
                    page: pageId,
                    year: self.year,
                    month: self.month
                }

                console.log(data)
                self.getOffDutyDaysOverview(self, data);
                console.log(pageId)
            }
        });
    }

    getOffDutyDaysOverview(self, data) {
        utilities.postAjax('/teacher/' + self.teacherId + '/getOffDutyDays', data, self.setOffDutyDaysOverview, self)
    }

    setOffDutyDaysOverview(response, self) {
        $('.offDutyDaysPagination').remove();
        $('.offDutyList').find('.list-group').replaceWith(response);
        self.setOffDutyPaginationButtonsEvent(self);
    }

    getSickDaysOverview(self, data) {
        utilities.postAjax('/teacher/' + self.teacherId + '/getSickDays', data, self.setSickDayOverview, self)
    }

    setSickDayOverview(response, self) {
        $('.sickDaysPagination').remove();
        $('.sickDayList').find('.list-group').replaceWith(response);
        self.setSickDaysPaginationButtonsEvent(self);
    }

    setSickDayCreateButtonEvent(self) {
        $('.createSickDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            let teacherId = $(this).data('teacherid');

            modal.getModal(modalId, self, self.submitCreateSickDay, teacherId);
        });
    }

    submitCreateSickDay(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#sickDayForm').submit();
        });
    }

    setSickDayDeleteButtonEvent(self) {
        $('.deleteSickDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            self.sickDayId = $(this).data('sickdayid');

            modal.getModal(modalId, self, self.submitDeleteSickDay);
        });
    }

    submitDeleteSickDay(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            window.location.href = '/teacher/' + self.teacherId + '/sickDay/' + self.sickDayId + '/delete';
        });
    }

    setSickDayEditButtonEvent(self) {
        $('.editSickDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            self.sickDayId = $(this).data('sickdayid');

            modal.getModal(modalId, self, self.submitEditSickDay, self.sickDayId);
        });
    }

    submitEditSickDay(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#sickDayForm').submit();
        });
    }

    setOffDutyDayDeleteButtonEvent(self) {
        $('.deleteOffDutyDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            self.offDutyDayId = $(this).data('offdutydayid');

            modal.getModal(modalId, self, self.submitDeleteOffDutyDay);
        });
    }

    submitDeleteOffDutyDay(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            window.location.href = '/teacher/' + self.teacherId + '/offDutyDay/' + self.offDutyDayId + '/delete';
        });
    }

    setOffDutyDayCreateButtonEvent(self) {
        $('.createOffDutyDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            let teacherId = $(this).data('teacherid');

            modal.getModal(modalId, self, self.submitOffDutyDayForm, teacherId);
        });
    }

    setOffDutyDayEditButtonEvent(self) {
        $('.editOffDutyDayButton').on('click', function () {
            let modalId = $(this).data('modalid');
            self.offDutyDayId = $(this).data('offdutydayid');

            modal.getModal(modalId, self, self.submitOffDutyDayForm, self.offDutyDayId);
        });
    }

    submitOffDutyDayForm(self, newModal) {
        $(newModal).find('.submitButton').on('click', function () {
            $(newModal).find('#offDutyDayForm').submit();
        });
    }
}

new absencesOverview();
