



window.addEvent('domready',function()
{
	
	
	// build gallery
	if( window.location.pathname.length>1 && $$('#content img').length)
	{
		var activeImg = 0;
		function showImg(i)
		{
			$$('.imageBox.active').removeClass('active').fade('out');
			$$('.imageBox')[i].addClass('active').setStyle('display','block').fade('in');
			$$('#items a.active').removeClass('active');
			$$('#items a')[i].addClass('active');
			activeImg = i;
		}
		$('items').empty();
		$$('#content img').each( function(num,i)
		{
			num.erase('width').erase('height');
			var im = new Element( 'div', { 'class':'imageBox' }).inject( $('content'), 'before');
			var st = num.getParent('p').getNext('p');
			st = st && st.getElements('img').length ? null : st;
			num.inject( im);
			if( st) st.inject( im);
			var next = new Element( 'a', { 'class':'next', href:'#', text:'>', title:'Zum nächsten Bild' }).inject( im);
			next.addEvent( 'click', function(ev)
			{
				ev.preventDefault();
				var ni = activeImg<$$('.imageBox').length-1 ? activeImg+1 : 0;
				showImg(ni);
			});
			im.set( 'tween', { onComplete: function()
			{
				if( !im.get('opacity')) im.setStyle('display','none');
			}});
			var li = new Element( 'li', { 'html':' ' }).inject( $('items'));
			var a = new Element( 'a', { href:'#' }).inject( li);
			a.addEvent( 'click', function(ev)
			{
				ev.preventDefault();
				showImg(i);
			});
			num.clone().inject( a);
			if( i) im.fade('hide');
			else 
			{ 
				a.addClass('active'); 
				im.addClass('active');
			}
		});
		$('content').dispose();
	}
	
	
});