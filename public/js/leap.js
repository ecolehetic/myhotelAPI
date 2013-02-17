$(function(){
	$('.company-menu a').bind('click',function(){
		var $this=$(this);
		$('.our-story div.row').load($this.attr('href'));
		$('.company-menu li').removeClass('active');
		$this.parent('li').addClass('active');
		// $.ajax({url:$(this).attr('href')})
		// 		.success(function(response){
		// 			$('.our-story div.row').html(response);
		// 		});
		return false;
	});
});