<script type="text/javascript" charset="utf-8">
$(function(){
	$('#menu2 li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#menu ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>
