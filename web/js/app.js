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