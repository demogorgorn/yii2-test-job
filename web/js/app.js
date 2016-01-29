$(function () {

    $(document).on('click', 'a.ajax', function (e) {
        var $target = $(e.target);
        e.preventDefault();
        getContent($target.attr('href'));
    });


    $(document).on('click', '#breadcrumbs a', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        $.pjax.reload({url: url, container: "#site"});
    });


    $(document).on('pjax:click', function (e) {
        var $target = $(e.target);

        //
    });


    $(document).on('pjax:end', function (e) {
        var $target = $(e.target);

        var reload = $('#reload');
        reload.css({paddingTop: 200});
        reload.animate({paddingTop: "0"});
    });


    $(document).bind('ajaxStart', function (e, xhr, settings) {
        loading(true);
    });


    $(document).bind('ajaxComplete', function (e, xhr, settings) {
        loading(false);
    });
});


function getContent(url) {
    $.get(url, function (request, status, xhr) {

        history.pushState({}, "", url);

        var reload = $('#reload');
        reload.css({paddingTop: 200});
        reload.html(xhr.responseText);
        reload.animate({paddingTop: "0"});

        $('.alert.alert-success').hide();
        $('.alert.alert-danger').hide();

        $.pjax.reload({container: "#breadcrumbs"});
    });
}


function loading(show) {
    show = show || false;

    if (show) {
        var loading = document.createElement('div');
        loading = $(loading).attr('id', 'loading');
        $('body').append(loading);
    } else {
        $('#loading').remove();
    }
}