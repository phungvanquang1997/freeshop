$(document).ready(function(){
	$('.amount-group span.input-group-addon input[name=method]').change(function(){
		var method = $('.amount-group span.input-group-addon input[name=method]:checked').val(); 
		if (method == 'plus') {
            $('.amount-group span.input-group-addon.minus-label').removeClass('active');
            $('.amount-group span.input-group-addon.plus-label').addClass('active');
        } else {
            $('.amount-group span.input-group-addon.minus-label').addClass('active');
            $('.amount-group span.input-group-addon.plus-label').removeClass('active');
        }
	});
	if ($('.amount-group span.input-group-addon input[name=method]:checked').val() == 'plus') {
		$('.amount-group span.input-group-addon.minus-label').removeClass('active');
        $('.amount-group span.input-group-addon.plus-label').addClass('active');
    } else if($('.amount-group span.input-group-addon input[name=method]:checked').val() == 'minus') {
        $('.amount-group span.input-group-addon.minus-label').addClass('active');
        $('.amount-group span.input-group-addon.plus-label').removeClass('active');
    }
});