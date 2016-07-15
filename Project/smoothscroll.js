$(document).ready(function(){
	$("a[href^='#']").click(function(){
		event.preventDefault();
		var target = this.hash;
		var $target = $(target);
		$("html,body").stop().animate({'scrollTop':$target.offset().top},750,"swing",function(){
			window.location.hash = target;
			});
		});
	});