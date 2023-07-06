$(document).ready(function(){
	//chia tabs
	$('#tabs').tabs({
		collapsible:true,
		event: "click"
	});

});		 
$(document).ready(function(){
	$('.accordion_f-item.active .accordion_f-body').slideDown();
	$('.accordion_f-header').click(function(){
		$(this).parent().toggleClass('active');
		$(this).parent().children('.accordion_f-body').slideToggle();
	});
});