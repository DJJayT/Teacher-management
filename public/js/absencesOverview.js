class absencesOverview {

    teacherId = null;

    constructor() {
        this.init();
    }

    init() {
        let self = this;
        $(function () {
            self.setCalendarEvent(self);
            self.getTeacherId(self);
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
                let url = '/teacher/' + self.teacherId + '/absences/' + splittedValue[0] + '/' + splittedValue[1];

                console.log(url)

                utilities.postAjax(url, {}, function (success) {
                    $('.sickDayList').html(success);
                    console.log(success)
                }, self);

            }
        });
    }

    getTeacherId(self) {
        self.teacherId = $('meta[name="teacher_id"]').attr('content')
    }
}

new absencesOverview();