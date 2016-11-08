	
	//	Created by Reasanik
	$(document).ready(function()
	{
		var inputEvent = 'input';
		var selectEvent = 'change';
	//	var aEvents = events.split(' ');
		var $Reasanik = Reasanik.BattleEventUpdate;
	//	$Reasanik.event = event = aEvents[0];
		
		Reasanik.BattleEventCreate.setAllValues = false;
		
		$(BattleEvent.battle_player1_id).bind(inputEvent, {number:1}, $Reasanik.setBattlePlayerValue);
		$(BattleEvent.battle_player2_id).bind(inputEvent, {number:2}, $Reasanik.setBattlePlayerValue);
		
		$(BattleEvent.battle_player1_id).trigger(inputEvent);
		$(BattleEvent.battle_player2_id).trigger(inputEvent);
		
	//	$(BattleEvent.battlePlayer1Id).trigger(selectEvent);
	//	$(BattleEvent.battlePlayer2Id).trigger(selectEvent);
	});
	