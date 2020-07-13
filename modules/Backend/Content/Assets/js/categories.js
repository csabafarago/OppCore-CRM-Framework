$(function () {
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "aaSorting": [
        ]
    });
});


$(function () {
    $(".delete").click(function (ev) {
        ev.preventDefault(); // preventDefault should suffice, no return false
        var targetUrl = $(this).attr("href");
        $('#dialog').html('<p>Valóban törölni szertnéd a kategóriát?</p>');
        $('#dialog').dialog({
            title: "Megerősítés",
            buttons: [
                {
                    text: "Igen",
                    'class': 'btn-danger',
                    click: function() {
                        $.post(targetUrl).done(function (data) {
                        if(data.new_url){
                            $.get( data.new_url, function( data ) {
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
                    });
                    $('#dialog').html('');
                    $(this).dialog("close");
                    }
                }, 
                {
                    text: "Nem",
                    'class': 'btn-primary',
                    click: function() {
                        $(this).dialog("close");
                    }
                }]
        }).dialog('open');
    });
});

$(function () {
    $('#dialog').dialog({
        autoOpen: false,
        resizable: false,
        closeText: "X",
        modal: true,           
        open: function (event, ui) {
            $("#dialog-overlay").css({
                display: 'block',
            });
            $('body').addClass('stop-scrolling');
            $('.ui-dialog-buttonset button').addClass('btn btn-sm');
        },
        beforeClose: function (event, ui) {
            $("#dialog-overlay").css({
                display: 'none',
            });
            $('body').removeClass('stop-scrolling');
            $('.ui-dialog-buttonset button').removeClass('btn btn-sm');
        },
//        create:function () {
//            $(this).closest(".ui-dialog")
//                .find(".ui-button").eq(1).addClass("btn btn-danger");
//        },
        show: {effect: "fade", duration: 200},
        hide: {effect: "fade", duration: 200},
    });

//    $(".topper a").click(function (e) {
//        e.preventDefault();
//        $('#dialog').dialog('open');
//    });
});