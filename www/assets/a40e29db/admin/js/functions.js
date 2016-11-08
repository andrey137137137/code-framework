
//	Created by Reasanik
Reasanik.BattleEventCreate =
{
	
	//	General vars
	
	event:				false,
	
	//	Form vars
	
	separator:			'|',
	teem1Score:			0,
	teem2Score:			0,
	firstSelect:		true,
	
	forms:				'#forms',
	
	eventForm:			'#battle-event-form',
	eventFormCenter:	'#form-center',
	
	prevButton:			'#prevButton',
	nextButton:			'#nextButton',
	
	//	Search vars
	
	battleSearchForms:	'#battle-search-forms',
	
	battleSearchId:		'#battle_id',
	
	teem1Search:		'#teem1-search-form',
	teem1SearchId:		'#search_teem1_id',
	battle1SearchId:	'#search_battle1_id',
	
	teem2Search:		'#teem2-search-form',
	teem2SearchId:		'#search_teem2_id',
	battle2SearchId:	'#search_battle2_id',
	
	//		Ajax vars
	
	updatePlayers:		true,
	
	//	Grid vars
	
	markedPlayersCount:	0,
	
	player1Container:	'#battle-player1-grid-container',
	player1Grid:		'#battle-player1-grid',
	
	player2Container:	'#battle-player2-grid-container',
	player2Grid:		'#battle-player2-grid',
	
	playerGridKeysSpans:'.keys span',
	
	playerGridTable:	'.items tbody',
	playerGridTableTr:	'.items tbody tr',
	
	//	Search
	
	//		Ajax submits
	
	ajax: function(selectElemId)
	{
	//	alert(this.toSource());
	//	this.ajaxData = selectElemId;
	//	alert(this.ajaxData);
		$.ajax({
			'type':		'GET',
			'url':		'index.php?r=battleEvent/create',
			'async':	true,
			'cache':	false,
			'data':		{
							battleId: $(this.battleSearchId).val(),
							selectElemId: selectElemId
						},
			'dataType':	'html',
			'context':	this,
			'success':	function(data, textStatus, jqXHR)
						{
							var aData = data.split('<br />');
							var elemId = aData[0];
							
							$(BattleEvent[elemId]).replaceWith(aData[1]);
							this.firstSelect = true;
						},
			'error':	function(jqXHR, textStatus, errorThrown)
						{
							alert('Произошла ошибка "' + textStatus + '" при ajax-запросе!');
						}
		});
	},
	
	sendData: function(e)
	{
		var _this = e.data._this;
		var number = e.data.number;
		
		if (number == 1)
			$(_this.teem1Search).submit();
		else if (number == 2)
			$(_this.teem2Search).submit();
	},
	
	teemSearchSubmit: function(e)
	{
		var _this = e.data._this;
		var number = e.data.number;
		
		$(_this['player' + number + 'Grid']).yiiGridView('update', {
			data: $(this).serialize()
		});
		
		if (_this.updatePlayers)
		{
			_this.ajax('battlePlayer1Id');
			_this.ajax('battlePlayer2Id');
		}
		
		return false;
	},
	
	setBattleId: function(e)
	{
		_this = e.data._this;
		
		_this.ajax('selectPrevEvent');
		_this.ajax('prev_event_id');
		_this.ajax('next_event_id');
	//	_this.ajax('battlePlayer1Id');
	//	_this.ajax('battlePlayer2Id');
		
		$(_this.battle1SearchId).val( $(_this.battleSearchId).val() );
		$(_this.battle2SearchId).val( $(_this.battleSearchId).val() );
		
	//	_this.updatePlayers = true;
		$(_this.teem1SearchId).trigger(_this.event);
		
		_this.updatePlayers = false;
		$(_this.teem2SearchId).trigger(_this.event);
		
		_this.updatePlayers = true;
	//	$(BattleEvent.selectPrevEvent).trigger(_this.event);
	},
	
	//	Form
	
	//		Event navigation
	
	fixForm: function(e)
	{
		var _this = e.data._this;
		
		var position = 'fixed';
		
		var width = $(_this.player1Container).outerWidth();
		var height = $(_this.battleSearchForms).outerHeight();
		
		var selfHeight = $(_this.eventFormCenter).outerHeight();
		var contHeight = $(_this.forms).outerHeight();
		
		var left = $(_this.player1Container).offset().left;
		var top = $(_this.battleSearchForms).offset().top;
		
		var selfLeft = left + width;
		var selfTop = top + height;
		
		var bottom = $(_this.forms).offset().top + contHeight - height - selfHeight;
		
		var scrollTop = $(this).scrollTop();
		
		if (scrollTop > top)
			selfTop = height;
	//	if (scrollTop > selfTop)
	//		selfTop = height;
		else
			selfTop = selfTop - scrollTop;
		
	//	alert(bottom);
		if (scrollTop > bottom)
			selfTop = selfTop + bottom - scrollTop;
		
		selfLeft = Math.ceil(selfLeft - 32);
		selfTop = Math.ceil(selfTop);
		
		$(_this.eventFormCenter).css({
										'position':	position,
										'left':		selfLeft + 'px',
										'top':		selfTop + 'px'
									});
	},
	
	setEventNavigations: function()
	{
		if (this.firstSelect)
		{
			$(this.nextButton).attr('disabled', 'disabled');
			
			if ($(BattleEvent.selectPrevEvent + ' option').size() == 0)
			{
				$(this.prevButton).attr('disabled', 'disabled');
				
				$(BattleEvent.teem1_score).val('0');
				$(BattleEvent.teem2_score).val('0');
				
				$(BattleEvent.teem1_score).trigger('input');
				$(BattleEvent.teem2_score).trigger('input');
			}
			else
				$(this.prevButton).removeAttr('disabled');
			
			this.firstSelect = false;
		}
	},
		
	setPrevEvent: function(e)
	{
		var _this = e.data._this;
		var direction = e.data.direction;
		var inversion = -1*direction;
		var value = $(BattleEvent.selectPrevEvent).val();
		var options = BattleEvent.selectPrevEvent + ' option';
		var len = $(options).size();
		var cur;
		
		for (var i = 0; i < len; i++)
		{
			if ($(options).eq(i).val() == value)
				break;
		}
		
		if (i == len)
			return false;
		
		if (inversion < 0)
			cur = i - 1;
		else
			cur = i + 1;
		
	//	alert($(_this.prevButton));
		
		if (cur == len - 1)
		{
			$(_this.prevButton).attr('disabled', 'disabled');
			
			if ($(_this.nextButton).attr('disabled'))
				$(_this.nextButton).removeAttr('disabled');
		}
		else if (cur == 0)
		{
			$(_this.nextButton).attr('disabled', 'disabled');
			
			if ($(_this.prevButton).attr('disabled'))
				$(_this.prevButton).removeAttr('disabled');
		}
		else
		{
			if ($(_this.prevButton).attr('disabled'))
				$(_this.prevButton).removeAttr('disabled');
			
			if ($(_this.nextButton).attr('disabled'))
				$(_this.nextButton).removeAttr('disabled');
		}
		
		$(BattleEvent.selectPrevEvent).val( $(options).eq(cur).val() );
		$(BattleEvent.selectPrevEvent).trigger(_this.event);
	},
	
	checkCountValues: function(elem, mustCount)
	{
		var value = elem.val();
		
		if (value == null)
			return false;
		
		var values = value.split(this.separator);
		
		if (values.length != mustCount)
			return false;
		
		return values;
	},
	
	setBattlePlayerValue: function(number, playerId)
	{
		var battlePlayer = BattleEvent['battlePlayer' + number + 'Id'];
		var len = $(battlePlayer).children().length;
		var option;
		var search = true;
		var values;
		
		/*
		reg = new RegExp('^(' + option + '(\\|\\d+)+)');
		var str = '7|7|3|5';
		str.search(reg);
		*/
		
		for (var i = 1; i <= len; i++)
		{
			option = battlePlayer + ' :nth-child(' + i + ')';
			
			values = this.checkCountValues($(option), 4);
			
			if (values[0] == playerId)
			{
				search = false;
				break;
			}
		}
		
		if (search)
			return false;
		
	//	$(option).attr('selected', 'selected');
		$(battlePlayer).val( $(option).val() );
	},
	
	setAllValues: function(e)
	{
		var _this = e.data._this;
		
		_this.setEventNavigations();
		
		var values = _this.checkCountValues($(this), 9);
		
		if (!values)
			return false;
		
		$(BattleEvent.prev_event_id).val(values[0]);
		$(BattleEvent.next_event_id).val(values[1]);
		
		$(BattleEvent.teem1_score).val(values[2]);
		$(BattleEvent.teem2_score).val(values[3]);
		
		_this.teem1Score = values[2];
		_this.teem2Score = values[3];
		
		_this.setBattlePlayerValue(1, values[4]);
		_this.setBattlePlayerValue(2, values[5]);
		
		$(BattleEvent.event_type).val(values[6]);
		$(BattleEvent.event_direction).val(values[7]);
		$(BattleEvent.destruction_type_id).val(values[8]);
		
	//	countExecutedEvents = 0;
		
		$(BattleEvent.battlePlayer1Id).trigger(_this.event);
		$(BattleEvent.battlePlayer2Id).trigger(_this.event);
		
		_this.markPlayer(1, values[4]);
		_this.markPlayer(2, values[5]);
	},

	setValues: function(e)
	{
		var _this = e.data._this;
		
		var values = _this.checkCountValues($(this), 4);
		
		if (!values)
			return false;
		
		var number = e.data.number;
		
		$(BattleEvent['battle_player' + number + '_id']).val(values[0]);
		
		$(BattleEvent.battleId).val(values[1]);
		$(BattleEvent['teem' + number + 'Id']).val(values[2]);
		$(BattleEvent['player' + number + 'Id']).val(values[3]);
		
	//	countExecutedEvents++;
	//	alert(countExecutedEvents);
	//	if (countExecutedEvents > 2)
			_this.setEventType(number);
		
	//	_this.markPlayer(number, values[0]);
	},
	
	setEventType: function(number)
	{
		var value;
		
		if ($(BattleEvent.teem1Id).val() != $(BattleEvent.teem2Id).val())
		{
			value = 1;
		}
		else if (number == 2 && $(BattleEvent.player1Id).val() != $(BattleEvent.player2Id).val())
		{
			value = 2;				//	value = -2;
		}
		else if (number == 1 && $(BattleEvent.player1Id).val() != $(BattleEvent.player2Id).val())
		{
			value = 2;
		}
		else if (number == 1)
		{
			value = 3;				//	value = -3;
		}
		else
		{
			value = 3;
		}
		
		$(BattleEvent.event_type).val(value);
		
	//	$(BattleEvent.event_direction).trigger(this.event);
	},
	
	setTeemScore: function(e)
	{
		var _this = e.data._this;
		
		var eventType = $(BattleEvent.event_type).val();
		var eventDirection = $(BattleEvent.event_direction).val();
		
		var tmpTeem1Score = _this.teem1Score;
		var tmpTeem2Score = _this.teem2Score;
		
		if (eventType != 2)
		{
			if (eventDirection == 1)
			{
				tmpTeem1Score++;
			}
			else
			{
				tmpTeem2Score++;
			}
		}
		
		$(BattleEvent.teem1_score).val(tmpTeem1Score);
		$(BattleEvent.teem2_score).val(tmpTeem2Score);
		
		_this.setSuicide(e);
	},
	
	setTeemValue: function(e)
	{
		var _this = e.data._this;
		var number = e.data.number;
		
		if (number == 1)
			_this.teem1Score = $(BattleEvent['teem' + number + '_score']).val();
		else
			_this.teem2Score = $(BattleEvent['teem' + number + '_score']).val();
	},
	
	setSuicide: function(e)
	{
		var _this = e.data._this;
		
		if ($(BattleEvent.event_type).val() == 3)
		{
			var eventDirection = $(BattleEvent.event_direction).val();
			var value;
			
			if (eventDirection < 0)
			{
				$(BattleEvent.battlePlayer2Id).val(
					$(BattleEvent.battlePlayer1Id).val()
				);
			}
			else
			{
				$(BattleEvent.battlePlayer1Id).val(
					$(BattleEvent.battlePlayer2Id).val()
				);
			}
			
			$(BattleEvent.battlePlayer1Id).trigger(_this.event);
			$(BattleEvent.battlePlayer2Id).trigger(_this.event);
		}
	},
	
	//	Grid
	
	markDestroyed: function(selector)
	{
	//	var _this = e.data._this;
		var _this = this;
		
		_this.setEventNavigations();
		
		var selector = selector + ' ' + _this.playerGridTable;
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
	},
	
	getPlayerId: function(e)
	{
		var _this = e.data._this;
		var number = e.data.number;
		var playerGrid = _this['player' + number + 'Grid'];
		
		var index = $(playerGrid + ' ' + _this.playerGridTableTr).index($(this));
		
		var playerId = $(playerGrid + ' ' + _this.playerGridKeysSpans).eq(index).text();
		
		_this.setBattlePlayerValue(number, playerId);
		
	//	alert(BattleEvent['battlePlayer' + number + 'Id']);
		
		$(BattleEvent['battlePlayer' + number + 'Id']).trigger(_this.event);
	},
	
	markPlayer: function(number, value)
	{
		var eventType = $(BattleEvent.event_type).val();
	//	alert(eventType);
		var eventDirection = $(BattleEvent.event_direction).val();
		var teem1Id = $(BattleEvent.teem1Id).val();
		var teem2Id = $(BattleEvent.teem2Id).val();
	//	alert(eventType);
	//	alert(eventType != 1 && teem1Id == teem2Id);
		if (eventType != 1 && teem1Id == teem2Id)
		{
			if (teem1Id == $(this.teem1SearchId).val())
				number = 1;
			else if(teem1Id == $(this.teem2SearchId).val())
				number = 2;
			else
				return false;
			
			if (eventType == 2)
			{
				var confDestroyed;
				
				if (eventDirection < 0)
					confDestroyed = $(BattleEvent.battle_player1_id).val();
				else
					confDestroyed = $(BattleEvent.battle_player2_id).val();
			//	alert(confDestroyed);
			//	alert(value);
			//	alert(eventType == 2 && value == confDestroyed);
			}
		}
		
		var playerGrid = this['player' + number + 'Grid'];
		var trs = playerGrid + ' ' + this.playerGridTableTr;
		var tr;
		
		var keysSpans = playerGrid + ' ' + this.playerGridKeysSpans;
		var len = $(keysSpans).size();
		
		for (var i = 0; i < len; i++)
		{
			if ($(keysSpans).eq(i).text() == value)
				break;
		}
		
	//	alert(value + ', ' + $('span:contains(' + value + ')').text() + ', ' + index + ', ' + i + ', ' + $(keysSpans).eq(i).text());
		
	//	$(trs + '.selected').removeClass('selected');
		
		if (!this.markedPlayersCount)
			this.unmarkSelectedTrs();
		
		if (i < len)
		{
			tr = $(trs).eq(i);
			tr.addClass('selected');
			
		//	alert(number == 1 && $(BattleEvent.event_direction).val() == -1);
			if (eventType == 3
				|| (eventType == 2 && value == confDestroyed)
				|| (eventType == 1
					&& ((number == 1 && eventDirection < 0)
						|| (number == 2 && eventDirection > 0)
						)
					)
				)
			{
				if (tr.hasClass('odd'))
					tr.addClass('odd-destroyed');
				else if (tr.hasClass('even'))
					tr.addClass('even-destroyed');
			}
		}
		
		this.markedPlayersCount++;
		
		if (this.markedPlayersCount == 2)
			this.markedPlayersCount = 0;
	},
	
	unmarkSelectedTrs: function()
	{
		var player1GridTrs = this.player1Grid + ' ' + this.playerGridTableTr + '.selected';
		var player2GridTrs = this.player2Grid + ' ' + this.playerGridTableTr + '.selected';
	//	alert(player1GridTrs);
		$(player1GridTrs).removeClass('selected');
		$(player2GridTrs).removeClass('selected');
	}
};
