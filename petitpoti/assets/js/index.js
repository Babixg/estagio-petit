//Navbar
	$(document).ready(function (){
		$("#menuzinho-tab").preventDefault();
		$("#inicio-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#bg").offset().top-70
		    }, 1000);
		});

		$("#menuzinho-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#menuzinho").offset().top
		    }, 1000);
		});

		$("#cuidado-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#cuidado").offset().top
		    }, 1000);
		});

		$("#cursos-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#curso").offset().top
		    }, 1000);
		});

		$("#bistro-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#bistro").offset().top
		    }, 1000);
		});

		$("#midia-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#midia").offset().top
		    }, 1000);
		});

		$("#localizacao-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#localizacao").offset().top
		    }, 1000);
		});

		$("#contato-tab").click(function(){
		    $('html, body').animate({
		        scrollTop: $("#contato").offset().top
		    }, 1000);
		});
	});	