$(document). ready(function (){
	//confirm delete
	$(documen.body).on ('submit', '.js-confirm', function(){
		var $el=$(this)
		var text=$el.data('confirm') ? $el.data('confirm') : 'anda yakin melakukan tindakan ini?'
		var c=confirm(text);
		return c;
	});
});