$(function () {

    $(document)
        .on('pjax:start', function() { })
        .on('pjax:end',   function() {

            $('.kv-plugin-loading').hide();

            var select2Elemets = [
                '#bookform-categories',
                '#bookform-users'
            ];

            for (var i in select2Elemets) {
                var targetSelect2 = $(select2Elemets[i]);

                console.log (targetSelect2);

                if (targetSelect2.length) {
                    var settings = targetSelect2.attr('data-krajee-select2'),
                        id = targetSelect2.attr('id');
                        settings = window[settings];
                    $.when(targetSelect2.select2(settings));
                }
            }
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