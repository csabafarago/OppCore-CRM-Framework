$(document).ready(function () {
    $(document).on('submit', '.admin-form', function (e) {
        //var formData = $(this).serializeArray();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                if (data.new_url) {
                    $("html, body").animate({scrollTop: 0}, "slow");
                    $.get(data.new_url, function (data) {
                        $('.content-wrapper').html(data.output);
                        if (typeof data.message != 'undefined') {
                            showMessage(data.type, data.message);
                        }
                    });
                }
                if (typeof data.message != 'undefined') {
                    showMessage(data.type, data.message);
                }
                $('.content-wrapper').html(data.output);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails     
            }
        });

        e.preventDefault();
    });
    //todo fix hogy csak a kellő anchorrokra kerüljön rá a figyelés
    $(document).on('click', 'a', function (e) {
        e.preventDefault();
        if (
                $(this).attr("href") != '#' &&
                !$(this).hasClass('delete') &&
                !$(this).parent().parent().hasClass('cke_toolbar') &&
                $(this).data('toggle') != 'tab' &&
                typeof $(this).data('dt-idx') == 'undefined'
                ) {
            $.ajax({
                url: $(this).attr("href"),
                context: document.body,
                success: function (data) {
                    if (typeof data.message != 'undefined') {
                        showMessage(data.type, data.message);
                    }
                    $("html, body").animate({scrollTop: 0}, "slow");
                    $('.content-wrapper').html(data.output);
                },
            });
            return false;
        }
    });
});

function showMessage(type, message) {
    var system_notification = $('#system-notification');
    if (type !== false) {
        if (type == 0) {
            type = "failed"
        } else if (type == "success") {
            type = "success";
        }
        system_notification.append('<div class="' + type + ' alert">' + message + '</div>');
        system_notification.delay(300).fadeIn(1000).delay(6000).fadeOut(1000);
    }
}