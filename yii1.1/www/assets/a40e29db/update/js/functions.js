	
	//	Created by Reasanik
	Reasanik.BattleEventUpdate =
	{
		setBattlePlayerValue: function(e)
		{
			var number = e.data.number;
			
			var value = $(BattleEvent['battle_player' + number + '_id']).val();
			
			Reasanik.BattleEventCreate.setBattlePlayerValue(number, value);
			
			$(BattleEvent['battle_player' + number + 'Id']).trigger('change');
		}
	};
	