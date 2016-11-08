	
	//	Created by Reasanik
	$(document).ready(function()
	{
		var playerTitle = 'Player_title';
		var vehicleid = 'Player_vehicle_id';
		
		$('#' + vehicleid).bind('change', {id: vehicleid}, function(e)
		{
			var id = e.data.id;
			var search = true;
			
			for (var i = 0; search; i++)
			{//$("#my_select :nth-child(2)")
				if ($('#' + id + ' option:nth-child(' + i + ')').val() == $('#' + id).val())
					break;
			}
			
			var str = $('#Player_title').val();
			var space = ' ';
			
			if (!str)
				space = '';
			
			/*
			$('#Player_title').val(
									str
									+ space
									+ $('#' + id + ' option:nth-child(' + i + ')').text()
								);
			*/
			
			$('#Player_title').val(str
									+ space
									+ $('#' + id + ' option:selected').text()
								);
		});
	});
	