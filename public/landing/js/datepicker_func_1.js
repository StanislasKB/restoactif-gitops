
        // Extract start and end dates from the div
        var startDate = new Date($('#event-data').data('start'));
        var endDate = new Date($('#event-data').data('end'));

        $('#DatePicker').datepicker({
            showButtonPanel: true,
            inline: true,
            altField: '#datepicker_field',
            minDate: startDate,
            maxDate: endDate,
            beforeShowDay: function(date) {
                // Highlight dates within the range and disable dates outside the range
                if (date >= startDate && date <= endDate) {
                    return [true, 'highlight', ''];
                } else {
                    return [false, '', ''];
                }
            }
        });

        // Highlight all dates within the range
        function highlightRange(startDate, endDate) {
            var currentDate = new Date(startDate);
            while (currentDate <= endDate) {
                var formattedDate = $.datepicker.formatDate('mm/dd/yy', currentDate);
                $("a.ui-state-default:contains('" + currentDate.getDate() + "')").each(function() {
                    var dateText = $(this).text();
                    if (parseInt(dateText) === currentDate.getDate()) {
                        $(this).addClass('highlight');
                    }
                });
                currentDate.setDate(currentDate.getDate() + 1);
            }
        }

        // Set the datepicker to the start date initially and highlight the range
        $('#DatePicker').datepicker('setDate', startDate);
        highlightRange(startDate, endDate);
