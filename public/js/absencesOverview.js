class absencesOverview {

    teacherId = null;
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
            self.setSickDaysPaginationButtonsEvent(self);
            self.setOffDutyPaginationButtonsEvent(self);
        });
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
                    self.setSickDaysPaginationButtonsEvent(self);
                    self.setOffDutyPaginationButtonsEvent(self);
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
}

new absencesOverview();
