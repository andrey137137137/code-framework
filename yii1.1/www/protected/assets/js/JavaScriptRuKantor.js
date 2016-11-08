	
	//	Created by JavaScript.ru - Илья Кантор (Ilya Kantor)
	
	var JavaScriptRuKantor = {
		
		getElementsByClass: function(classList, node)
		{
			if (document.getElementsByClassName)
			{
				return (node || document).getElementsByClassName(classList);
			}
			else
			{
				var node = node || document;
				var list = node.getElementsByTagName('*');
				var length = list.length;
				var classArray = classList.split(/\s+/);
				var classes = classArray.length;
				var result = [], i, j;
				
				for (i = 0; i < length; i++)
				{
					for (j = 0; j < classes; j++)
					{
						if (list[i].className.search('\\b' + classArray[j] + '\\b') != -1)
						{
							result.push(list[i]);
							break;
						}
					}
				}
				
				return result;
			}
		},
		
		addEvent: function(elem, evType, fn)
		{
			if (elem.addEventListener)
			{
				elem.addEventListener(evType, fn, false);
				
				return fn;
			}
			
			iefn = function()
			{
				fn.call(elem);
			}
			
			elem.attachEvent('on' + evType, iefn);

			return iefn;
		},
		
		removeEvent: function(elem, evType, fn)
		{
			
			if (elem.addEventListener)
			{
				elem.removeEventListener(evType, fn, false);
				
				return;
			}
			
			elem.detachEvent('on' + evType, fn);
		},
		
		getCookie: function(name)
		{
			var matches = document.cookie.match(new RegExp(
			  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			
			return matches ? decodeURIComponent(matches[1]) : undefined;
		},
		
		setCookie: function(name, value, props)
		{
			var props = props || {};
			var exp = props.expires;
			
			if (typeof exp == "number" && exp)
			{
				var d = new Date();
				d.setTime(d.getTime() + exp*1000);
				exp = props.expires = d;
			}
			
			if(exp && exp.toUTCString)
			{
				props.expires = exp.toUTCString();
			}
			
			var value = encodeURIComponent(value);
			var updatedCookie = name + "=" + value;
			
			for (var propName in props)
			{
				updatedCookie += "; " + propName;
				var propValue = props[propName];
				if (propValue !== true)
				{
					updatedCookie += "=" + propValue;
				}
			}
			
			document.cookie = updatedCookie;
		},
		
		deleteCookie: function(name)
		{
			this.setCookie(name, null, { expires: -1 });
		}
		
	};
	