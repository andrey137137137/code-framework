
//	Created by Reasanik
Reasanik.SiteSetScores =
{
	_this:			false,
	request:		false,
	data:			false,
	all:			false,
	step:			1,
	prefix:	'params[',
	postfix:	']=',
	
	sendRequest: function(params)
	{
		if (this.all)
			params.all = 1;
		
		$.ajax({
			'type': 'GET',
			'url': 'index.php?r=site/setScores',
			'async': false,
			'cache': false,
			'data': {params},
			'dataType': 'text',
			'context': this,
			'success': function(data, textStatus, jqXHR) {
				$('#content').append(textStatus + ': ' + data + '<br />');
				this.data = data;
			}
		});
		
		return this.data;
		/*
		var paramsStr = '';
		
		if (this.all)
			params.all = 1;
		
		for (prop in params)
		{
			paramsStr += encodeURI('&' + this.prefix + prop + this.postfix + params[prop]);
		}
		
		this.request = new XMLHttpRequest();
		
		this.request.open('GET', 'index.php?r=site/setScores' + paramsStr, false);
		this.request.setRequestHeader('Content-type', 'text/plain');
		this.request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		
		this.request.send(null);
		_this = this;
		
		this.request.onreadystatechange = this.getRequest();
		*/
	},
	/*
	getRequest: function()
	{
		if (!_this.request)
			return false;
		
		if (_this.request.readyState != 4 || _this.request.status != 200)
			return false;
		
		var type = _this.request.getResponseHeader('Content-type');
		
	//	if (type.match(/^text/) == null)
	//		return false;
		_this.data = _this.request.responseText;
	//	alert(_this.data);
	},
	*/
	setDefaults: function()
	{
		return this.sendRequest({'default':1});
	},
	
	getCount: function()
	{
		return this.sendRequest({count:1});
	},
	
	setScores: function(offset)
	{
		return this.sendRequest({offset:offset, limit:this.step});
	},
	
	clearRequest: function()
	{
		this.data = false;
	},
	
	execute: function()
	{
		if (!this.setDefaults())
			return false;
		
		this.clearRequest();
		this.all = false;
		
		var count = this.getCount();
		
		if (!count)
			return false;
		
		this.clearRequest();
		
		for (var i = 0; i < count; i += this.step)
		{
			this.setScores(i);
			this.clearRequest();
		}
	}
};
