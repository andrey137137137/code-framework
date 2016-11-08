	
	//	Created by Reasanik
	$(document).ready(function()
	{
		var events = 'change focus';
		var aEvents = events.split(' ');
		var event = aEvents[0];
		
		var siteNew = Reasanik.SiteNew;
		
		$(siteNew.battleSearch).submit(function()
		{
			$(siteNew.player1Grid).yiiGridView('update', {
				data: $(this).serialize()
			});
			
			$(siteNew.player2Grid).yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		$(siteNew.teem1Search).submit(function()
		{
			$(siteNew.player1Grid).yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		$(siteNew.teem2Search).submit(function()
		{
			$(siteNew.player2Grid).yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		function sendData(e)
		{
			switch (e.data.attr)
			{
				case 'battle':	$('#search_battle1_id').val(
									$('#BattlePlayer_battle_id').val()
								);
								
								$('#search_battle2_id').val(
									$('#BattlePlayer_battle_id').val()
								);
								
								$(siteNew.teem1SearchId).trigger(event);
								$(siteNew.teem2SearchId).trigger(event);
							//	$(siteNew.battleSearch).submit();
								break;
								
				case 'teem1':	$(siteNew.teem1Search).submit();
								break;
								
				case 'teem2':	$(siteNew.teem2Search).submit();
								break;
			}
		}
		
		function markDestroyed(e)
		{
			var selector = e.data.selector + ' .items tbody';
			
			var len = $(selector).children().length;
			var tr;
			var td;
		//	alert(len);
			for (var i = 1; i <= len; i++)
			{
				tr = selector + ' :nth-child(' + i + ')';
				td = tr + ' :last-child';
			//	alert($(selector + ' tr').addClass('destroyed'));
				if ($(td).text() == 3 || $(td).text() == 2)
				{
					if ($(tr).hasClass('odd'))
						$(tr).addClass('odd-destroyed');
					else if ($(tr).hasClass('even'))
						$(tr).addClass('even-destroyed');
				}
				
			//	alert(i + ' ' + $(td).text());
			}
		}
	//	$(siteNew.player1Container + ' .items tbody tr.odd').addClass('odd-destroyed');
	//	$(siteNew.player1Container + ' .items tbody tr.even').addClass('even-destroyed');
		$(siteNew.battleSearchId).bind(events, {attr:'battle'}, sendData);
		$(siteNew.teem1SearchId).bind(events, {attr:'teem1'}, sendData);
		$(siteNew.teem2SearchId).bind(events, {attr:'teem2'}, sendData);
		
		$(siteNew.player1Container).on('ready click', siteNew.player1Grid, {selector:siteNew.player1Grid}, markDestroyed);
		
		$(siteNew.player2Container).on('ready click', siteNew.player2Grid, {selector:siteNew.player2Grid}, markDestroyed);
		
	});
	