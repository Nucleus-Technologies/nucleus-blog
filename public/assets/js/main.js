$(function() {

	$('.home header').css('height', window.innerHeight);
	$('body.dashboard_login').css('height', window.innerHeight);
	$('div.editor div#ephox_editor').css('max-height', '500px');
	$('div.editor div#ephox_editor').css('height', '700px');
    
    $('.alert').fadeIn(900);
	
    setTimeout(function () {
        $('.alert').fadeOut(900);
    }, 8000);

	if ($('body').hasClass('home') || $('body').hasClass('post_page')) {
		
		let sr = ScrollReveal({ reset: true });

		sr.reveal('header h1.title', {
		origin: 'left',
		duration: 1000,
		delay: 100,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header p.intro', {
		origin: 'left',
		duration: 1000,
		delay: 300,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header button.cta', {
		origin: 'left',
		duration: 1000,
		delay: 500,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header div.count', {
		origin: 'left',
		duration: 1000,
		delay: 700,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header div.socials', {
		origin: 'top',
		duration: 1000,
		delay: 700,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header div.footer', {
		origin: 'bottom',
		duration: 1000,
		delay: 300,
		distance: '50%',
		mobile: true
	});

	sr.reveal('header div.next-post', {
		origin: 'bottom',
		duration: 1000,
		delay: 700,
		distance: '50%',
		mobile: true
	});

	sr.reveal('section.intro h1', {
		origin: 'bottom',
		duration: 1000,
		delay: 400,
		distance: '50%',
		mobile: true
	});

	sr.reveal('section.intro p', {
		origin: 'bottom',
		duration: 1000,
		delay: 1800,
		distance: '50%',
		mobile: true
	});

	sr.reveal('section.intro div.caption', {
		origin: 'left',
		duration: 1000,
		delay: 1000,
		distance: '50%',
		mobile: true
	});

	sr.reveal('div.post', {
		origin: 'bottom',
		duration: 1000,
		delay: 500,
		distance: '50%',
		mobile: true
	});

	sr.reveal('.post_page header div.author img', {
		origin: 'top',
		duration: 1000,
		delay: 500,
		distance: '50%',
		mobile: true
	});

	sr.reveal('.post_page div.close_post a', {
		origin: 'top',
		duration: 1000,
		delay: 500,
		distance: '50%',
		mobile: true
	});

	sr.reveal('.post_page header div.author div.details', {
		origin: 'left',
		duration: 1000,
		delay: 1000,
		distance: '10%',
		mobile: true
	});

	sr.reveal('.post_page header div.title h1', {
		origin: 'left',
		duration: 1000,
		delay: 700,
		distance: '10%',
		mobile: true
	});

	sr.reveal('div.likes, div.network', {
		origin: 'bottom',
		duration: 1000,
		delay: 1500,
		distance: '10%',
		mobile: true
	});

	sr.reveal('.post_page div.description p', {
		origin: 'top',
		duration: 1000,
		delay: 2000,
		distance: '10%',
		mobile: true
	});

	}

	$('img.avatar_btn').click(function() {
		$('input#avatar').click();
	});
	
	$('input#avatar').change(function() {
		$('.avatar_btn')[0].src = window.URL.createObjectURL($('#avatar')[0].files[0]);
	});
	
	$('.menu-btn').click(function() {
		$('.menu').addClass('visible');
		$('.menu').removeClass('hidden');
	});

	$('.close-btn').click(function() {
		$('.menu').addClass('hidden');
		$('.menu').removeClass('visible');
	});

	$('a.menu_btn').click(function() {
		$('.mobile_menu').slideDown(300);
	});

	$('li.close_menu a').click(function() {
		$('.mobile_menu').slideUp(300);
	});

	$('.save_btn').click(function() {
		$(this).parent().parent().children()[1].children[0].submit();
	});
	
	$('#login_btn').click(function() {
	    $('#login_form').submit();
    });
	
	$('.hero_btn').click(function() {
		$('input#hero').click();
	});
	
	$('.save_story_btn').click(function() {
		/* var input = {
			'title': $('#title').val(),
			'description': $('#description').val(),
			'hero': window.URL.createObjectURL($('#hero')[0].files[0]),
			'content': editor.content.get()
		};
		
		$.post({
			url: '/writer/stories',
			data: input,
			success: function(data) {
				console.log(data);
			},
			error: function(data) {
				console.log(data);
			}
		}); */
		
		$('#story_form').submit();
	});

});
