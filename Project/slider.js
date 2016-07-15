$(document).ready(function(){
	var canvas = document.getElementById("Canvas1");
	var ctx = canvas.getContext("2d");
	ctx.strokeStyle= "#ffffff";
	ctx.lineWidth=2;
	ctx.moveTo(0,0);
	ctx.lineTo(20,30);
	ctx.stroke();
	ctx.moveTo(20,30);
	ctx.lineTo(0,60);
	ctx.stroke();
				
	canvas = document.getElementById("Canvas2");
	ctx = canvas.getContext("2d");
	ctx.strokeStyle= "#ffffff";
	ctx.lineWidth=2;
	ctx.moveTo(20,0);
	ctx.lineTo(0,30);
	ctx.stroke();
	ctx.moveTo(0,30);
	ctx.lineTo(20,60);
	ctx.stroke();
				
	var slideCount = $(".slider").children().length;
	var slideIndex = 0;
	var sliderWidth = 100*(slideCount+2) + "%";
	$(".slider").css("width",sliderWidth);
	var slideWidth = 100/(slideCount+2) + "%";
	$(".slider div").css("width",slideWidth);
				
	$(".slider").find("div:first-child").clone().appendTo(".slider");
	$(".slider").find("div:nth-last-child(2)").clone().prependTo(".slider");
	$(".slider").css("left","-100%");
				
	//setInterval(slide,4500);
	var temp;
	var clear;
	changeIndicator();
	clear = setTimeout(slide,4500,0);
	$("#Canvas1").one("click",next);
	$("#Canvas2").one("click",previous);
				
	function slide(direction)
	{
		if(direction == 0)
			slideIndex++;
		else 
            slideIndex--;					
		temp = (slideIndex * (-100) - 100) + "%";
		changeIndicator();
		$(".slider").animate({'left':temp},500,"swing");
		if(slideIndex >= slideCount)
		{
			setTimeout(function(){$(".slider").css('left','-100%');},550);
			slideIndex = 0;
			}
		else if(slideIndex < 0)
		{
			setTimeout(function(){$(".slider").css('left',(-100)*slideCount + '%');},550);
			slideIndex = slideCount - 1;
			}	
		clear = setTimeout(slide,4500,0);   
		}
	function next()
	{
		clearTimeout(clear);
		setTimeout(function(){$("#Canvas1").one("click",next);},400);
		slide(0);
		}	
	function previous()
	{
		clearTimeout(clear);
		setTimeout(function(){$("#Canvas2").one("click",previous);},400);
		slide(1);
		}
	function changeIndicator()
	{
		var currentSlide;
		if(slideIndex >=slideCount)
			currentSlide = 1;
		else if(slideIndex < 0)
            currentSlide = slideCount;
		else
			currentSlide = slideIndex + 1;
		$(".indicator label span").removeClass("active");
		//$("label span").get(currentSlide).addClass("active");
		$(".indicator label:nth-of-type("+currentSlide+") span").addClass("active");
		}
	$('.indicator label span').click(function(){
		$('.indicator label span').removeClass("active");
		$(this).addClass("active");
		clearTimeout(clear);
		for(var i = 0;i < slideCount;i++)
			if($(".indicator label span").get(i) == $(this).get(0))
				break;		
		slideIndex = i;
		temp = (slideIndex * (-100) - 100) + "%";
		$(".slider").animate({'left':temp},500);
		clear = setTimeout(slide,4500,0);
		});
					
	});