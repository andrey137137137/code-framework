	
	//	Created by Reasanik
	$(document).ready(function()
	{
		var events = 'focus input';
		
		$('#Player_destroyed_enemies').bind(events, calculateScore);
		$('#Player_destroyed_confederates').bind(events, calculateScore);
		$('#Player_suicides').bind(events, calculateScore);
		
		function prepareValue(id)
		{
			if ($('#Player_' + id).val() == '')
				$('#Player_' + id).val(0);
		}
		
		function calculateScore(e)
		{
			prepareValue('destroyed_enemies');
			prepareValue('destroyed_confederates');
			prepareValue('suicides');
			
			$('#Player_score').val(
				$('#Player_destroyed_enemies').val() -
				$('#Player_destroyed_confederates').val() -
				$('#Player_suicides').val()
			);
		}
	});
	