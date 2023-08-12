
jQuery( document).ready( function() {
	var $ = jQuery;

	// mobile nav
	$('#mobile-nav').removeClass('open');
	$('#mobile-nav .site-title a').click( function(ev) {
		ev.preventDefault();
		$('#mobile-nav').toggleClass('open');
	});

	// shorten galleries and add interactivity
	$.each( $('.gallery'), function(i,g) {
		g = $(g).addClass('js-enabled');
		var gis = g.find('.gallery-item');
		$.each(gis, function(j,gi) {
			gi = $(gi);
			gi.find('a').attr('title', gi.find('dd').text().trim());
		});
		var html = '<span class="subtitle">';
		html += '<a href="#prev" class="prev">←</a>';
		html += gis.length+' Arbeit'+(gis.length>1 ? 'en' : '');
		html += '<a href="#next" class="next">→</a>';
		html += '</span>';
		var h = g.prev('h1, h2, h3, h4, h5').append(html),
			nb = h.find('a.next').click(next),
			pb = h.find('a.prev').click(prev),
			fgi = gis.first(),
			lgi = gis.last(),
			curr = 0,
			gw, lir, rl;
		function next(ev) {
			ev.preventDefault();
			addLimitedMargin( -gw * .8, ev);
		}
		function prev(ev) {
			ev.preventDefault();
			addLimitedMargin( gw * .8, ev);
		}
		function addLimitedMargin(amt,ev) {
			// console.log('addLimitedMargin('+amt+') curr='+curr);
			if(ev) ev.preventDefault();
			amt = isNaN(amt) ? 0 : amt;
			curr = parseInt(fgi.css('marginLeft'));
			fgi.css( 'margin-left', limit( curr + amt) + 'px');
		}
		function limit(margin) {
			// console.log('limit('+margin+')');
			margin = Math.round(margin);

			// min: inner width + some padding right
			gw = g.outerWidth();
			lir = Math.round( lgi.position().left + lgi.width());
			rl = Math.round( curr - lir + gw - gw*.1);
			// console.log({margin:margin, gw:gw, curr:curr, lir:lir, rl:rl});
			nb.css('display', margin <= rl ? 'none' : '');
			margin = Math.max( margin, rl);

			// max: 0
			pb.css('display', margin >= 0 ? 'none' : '');
			margin = Math.min( margin, 0);

			return margin;
		}
		$(window).on('load resize', addLimitedMargin);
		addLimitedMargin();
	});



});

