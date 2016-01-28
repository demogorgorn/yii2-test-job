$(function () {

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


$( document ).ajaxComplete(function() {


    //$("#bookform-users").select2();



/*
    var $el = $("#bookform-categories"), // your input id for the HTML select input
        settings = $el.attr('data-krajee-select2'),
        id = $el.attr('id');
    settings = window[settings];

// reinitialize plugin, set bootstrap error/success style and reset loading status
    $.when($el.select2(settings).on('select2-open', function() {
        initSelect2DropStyle(id);
    }).done(initSelect2Loading(id));
*/




    console.log (2323);
});