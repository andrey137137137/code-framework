
//	Created by Reasanik
$(document).ready(function()
{
	var events = 'change focus';
	var aEvents = events.split(' ');
	var obj = Reasanik.BattleEventCreate;
	var event = aEvents[0];
	
	obj.event = event;
	
	//	Form
	
	//		Selection of events
	
	$(obj.eventForm).on(event, BattleEvent.selectPrevEvent, {_this:obj}, obj.setAllValues);
	
	//		Selection of battle players
	
	$(obj.eventForm).on(events, BattleEvent.battlePlayer1Id, {_this:obj, number:1}, obj.setValues);
	$(obj.eventForm).on(events, BattleEvent.battlePlayer2Id, {_this:obj, number:2}, obj.setValues);
	
	//		Setting teem scores
	
	$(BattleEvent.teem1_score).on('input', {_this:obj, number:1}, obj.setTeemValue);
	$(BattleEvent.teem2_score).on('input', {_this:obj, number:2}, obj.setTeemValue);
	
	//		Navigation of events
	
	$(obj.prevButton).on('click', {_this:obj, direction:-1}, obj.setPrevEvent);
	$(obj.nextButton).on('click', {_this:obj, direction:1}, obj.setPrevEvent);
	
	//		Shows who was destroying and who was destroyed.
	//		In case suicide: who got advantage
	
	$(BattleEvent.event_direction).on(events, {_this:obj}, obj.setTeemScore);
	
	//		How was destroyed
	
	$(BattleEvent.event_type).on(event, {_this:obj}, obj.setSuicide);
	
	//$(BattleEvent.selectPrevEvent).trigger(event);
	
	$(document).on('ready scroll', {_this:obj}, obj.fixForm);
	
	//	Search
	
	$(obj.teem1Search).submit({_this:obj,number:1}, obj.teemSearchSubmit);
	$(obj.teem2Search).submit({_this:obj,number:2}, obj.teemSearchSubmit);
	
	$(obj.battleSearchId).on(event, {_this:obj}, obj.setBattleId);
	
	$(obj.teem1SearchId).on(event, {_this:obj,number:1}, obj.sendData);
	$(obj.teem2SearchId).on(event, {_this:obj,number:2}, obj.sendData);
	
	$(obj.player1Container).on('click', obj.playerGridTableTr, {_this:obj, number:1}, obj.getPlayerId);
	$(obj.player2Container).on('click', obj.playerGridTableTr, {_this:obj, number:2}, obj.getPlayerId);
	
	$(document).bind('ready ajaxStop', {_this:obj}, function(e){
		var _this = e.data._this;
		
		_this.markDestroyed(_this.player1Grid);
		_this.markDestroyed(_this.player2Grid);
		$(BattleEvent.selectPrevEvent).trigger(event);
	//	$(_this.player1Grid).trigger('click');
	//	$(_this.player2Grid).trigger('click');
	});
	
	/*
	$(document).bind({
		ajaxStart: function() { alert(document); },
		ajaxStop: function() { alert(document); },
	});
	
	$('table').on('click', 'td', function () {
		$('td').not($(this).toggleClass('click')).removeClass('click');
	});
	*/
});
