jQuery(document).ready(function( $ ) {
	/* premium indicator */
    $("input.premium").attr('disabled', 'disabled');
    var prem = $("input.premium").parent();
    $(prem).append('<span class="pro">PRO</span>');

    /* premium indicator */
    $("select.premium").attr('disabled', 'disabled');
    var prem = $("select.premium").parent();
    $(prem).append('<span class="pro">PRO</span>');
});

