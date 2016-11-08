	
	//	Created by Reasanik
	$(document).ready(function()
	{
		var events = 'focus input';
		
		$('#BattlePlayer_destroyed_enemies').bind(events, calculateScore);
		$('#BattlePlayer_destroyed_confederates').bind(events, calculateScore);
		
		function prepareValue(id)
		{
			if ($('#BattlePlayer_destroyed_' + id).val() == '')
				$('#BattlePlayer_destroyed_' + id).val(0);
		}
		
		function calculateScore(e)
		{
			prepareValue('enemies');
			prepareValue('confederates');
			
			$('#BattlePlayer_score').val(
				$('#BattlePlayer_destroyed_enemies').val() -
				$('#BattlePlayer_destroyed_confederates').val()
			);
		}
	});
	