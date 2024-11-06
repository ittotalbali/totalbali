
$(function () {
    var id = document.getElementById("id_villa").value;
    // console.log(value)
    $.ajax({
        url: "/admin/kalender-ical/" + id,
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (data) {
            // console.log(data);
            var sptCalendarEvents = {
                id: 1,
                events: data,
            };
            $('#calendar-ical').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today',
                    // right: 'month'
                },
                contentHeight: 480,
                firstDay: 1,
                defaultView: 'month',
                displayEventTime: false,

                allDayText: 'All Day',
                views: {
                    agenda: {
                        columnHeaderHtml: function (mom) {
                            return '<span>' + mom.format('ddd') + '</span>' +
                                '<span>' + mom.format('DD') + '</span>';
                        }
                    },
                    day: {
                        columnHeader: false
                    },
                    listMonth: {
                        listDayFormat: 'ddd DD',
                        listDayAltFormat: false
                    },
                    listWeek: {
                        listDayFormat: 'ddd DD',
                        listDayAltFormat: false
                    },
                    agendaThreeDay: {
                        type: 'agenda',
                        duration: {
                            days: 3
                        },
                        titleFormat: 'MMMM YYYY'
                    }
                },
                // eventSources: [sptCalendarEvents, sptBirthdayEvents, sptHolidayEvents, sptOtherEvents],
                eventSources: [sptCalendarEvents],
                eventAfterAllRender: function (view) {
                    if (view.name === 'listMonth' || view.name === 'listWeek') {
                        var dates = view.el.find('.fc-list-heading-main');
                        dates.each(function () {
                            var text = $(this).text().split(' ');
                            var now = moment().format('DD');
                            $(this).html(text[0] + '<span>' + text[1] +
                                '</span>');
                            if (now === text[1]) {
                                $(this).addClass('now');
                            }
                        });
                    }
                },
                eventRender: function (event, element) {
                    if (event.description) {
                        element.find('.fc-list-item-title').append(
                            '<span class="fc-desc">' + event.description +
                            '</span>');
                        element.find('.fc-content').append(
                            '<span class="fc-desc">' + event.description +
                            '</span>');
                    }
                    var eBorderColor = (event.source.borderColor) ? event.source
                        .borderColor : event.borderColor;
                    // console.log(eBorderColor);
                    element.find('.fc-list-item-time').css({
                        color: eBorderColor,
                        borderColor: eBorderColor
                    });
                    element.find('.fc-list-item-title').css({
                        borderColor: eBorderColor
                    });
                    element.css('borderLeftColor', eBorderColor);
                },
            });
            // console.log(data);
        },
        error: function (err) {
            // console.log(err);
        }
    })


})