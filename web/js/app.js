$(function () {

    $(document).on('click', 'a[href]', function (e) {
        e.preventDefault();
        var $this = $(this);
        $('.navbar-nav.navbar-right.nav').find('li').removeClass('active');
        $.get($this.attr('href'), function( request, status, xhr ) {

            history.pushState({}, "", $this.attr('href'));

            var reload = $('#reload');
            reload.css({paddingTop: 200});

            //request = request.replace(/<script(.*)<\/script>/g,'');
            //request = request.replace(/<link(.*?)>/g,'');

            reload.html(request);
            reload.animate({paddingTop:"0"});
        });
    });

    $(document).on('click', '.navbar-nav.navbar-right.nav a', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.parents('li').addClass('active');
    });

    $( document ).ajaxComplete(function( event, xhr, settings) {

    });

    /**
     * Шаблон должностей
     * @type {null}
     */
    var templatePosition = null;

    /**
     * Удалить должность
     */
    $(document).on('click', '.remove-position', function () {
        var $this = $(this);
        var $li = $this.parents('li');
        var $position = $this.parents('.position');
        if ($li.length) {
            $li.remove();
        }
        else if ($position.length) {
            $position.remove();
        }
    });

    /**
     * Добавить должность
     */
    $(document).on('click', '#add-position', function () {
        var $this = $(this);

        var position = $('#positions').find('.position.row').first().clone();
        position.find('input').val('');
        position.appendTo('#positions');
    });

});