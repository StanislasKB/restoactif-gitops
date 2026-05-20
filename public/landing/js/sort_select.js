(function($) {
    'use strict';

    $('.sort-select').on('change', function() {
        let value = $(this).val();
        if (value != '') {
            var url = $(this).data('page_url') + 'sort_by=' + value;
            window.location.href = url;
        }
    });
})(jQuery);
