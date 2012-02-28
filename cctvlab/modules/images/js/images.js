

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();

    if (window.location.hostname === 'blueimp.github.com') {
        // Demo setting:
        $('#fileupload form').prop(
            'action',
            '//jquery-file-upload.appspot.com'
        );
    } else {
        // Load existing files:
        $.getJSON($('#fileupload form').prop('action'), function (files) {
            var fu = $('#fileupload').data('fileupload');
            fu._adjustMaxNumberOfFiles(-files.length);
            fu._renderDownload(files)
                .appendTo($('#fileupload .files'))
                .fadeIn(function () {
                    // Fix for IE7 and lower:
                    $(this).show();
                });
        });
    }

    // Enable iframe cross-domain access via redirect page:
    $('#fileupload').bind('fileuploadsend', function (e, data) {
        if (data.dataType.substr(0, 6) === 'iframe') {
            var target = $('<a/>').prop('href', data.url)[0];
            if (window.location.host !== target.host) {
                data.formData.push({
                    name: 'redirect',
                    value: window.location.href.replace(
                        /\/[^\/]*$/,
                        '/result.html?%s'
                    )
                });
            }
        }
    });

    // Open download dialogs via iframes,
    // to prevent aborting current uploads:
    $('#fileupload .files').delegate(
        'a:not([rel^=gallery])',
        'click',
        function (e) {
            e.preventDefault();
            $('<iframe style="display:none;"></iframe>')
                .prop('src', this.href)
                .appendTo('body');
        }
    );
});