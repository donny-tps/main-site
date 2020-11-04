jQuery(document).ready(function () {
    jQuery('.datepicker').datepicker({
        dateFormat: 'd-mm-yy'
    });
    jQuery('span.count').each(function () {
        var obj = jQuery(this);
        jQuery({countNum: obj.text()}).animate({countNum: obj.data('count')}, {
            duration: 2000,
            easing: 'linear',
            step: function () {
                obj.text(Math.floor(this.countNum));
            },
            complete: function () {
                obj.text(this.countNum);
            }
        });
    });
    jQuery('.tp-edit').click(function () {
        jQuery(this).parent().find('form').slideToggle();
    });
});