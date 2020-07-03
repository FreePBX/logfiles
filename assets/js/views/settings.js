/**
 * UI Config Settings
 * 
 * @author Javier Pastor (VSC55)
 * @license GPLv3
 */

$(document).ready(function()
{

	$(".settings_input").each(settings_get_value);
	$(document).on("click", ".setting_realod", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		$(t).closest('.form-group').find('input').each(settings_get_value);
	});
	$(document).on("click", "input:radio.settings_input", function(e)
	{
		// Not run "preventDefault" because it stops the selection of the radio
		// e.preventDefault();
		t = e.target || e.srcElement;
		settings_save(null, t);
	});
	$(document).on("click", ".setting_save", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		$(t).closest('.form-group').find('input').each(settings_save);
	});

	$('#logfiles_add_new_line').on("click", logfiles_add_new_line);
	$(document).on("click", ".logfiles_add_new", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		logfiles_add_new(t);
	});
	$(document).on("click", ".logfiles_add_cancel", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		var process = new logfiles_process(t);
		process.removeRow(false);
	});
	$(document).on("click", ".logfiles_save", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		logfiles_save(t);
	});
	$(document).on("click", ".logfiles_destory", function(e)
	{
		e.preventDefault();
		t = e.target || e.srcElement;
		logfiles_destory(t);
	});

});


function show_btn_apply_conf()
{
	$('#button_reload').show();
}


/*
 * INIT > TAB - LOG_FILES
 */

function is_Numeric(num)
{
	return !isNaN(parseFloat(num)) && isFinite(num);
}

function logfiles_cell_id(value, row, index, field)
{
	var html = $('<input/>', { 
					'type': 'hidden',
					'name': field,
					'value': value
				})
				.get(0).outerHTML;

	html += value;
	return html;
}

function logfiles_cell_acction(value, row, index)
{
	return $('<div/>', {
				'role': 'group',
				'class': 'btn-group btn-group-justified blocks'
			})
			.append(
				$('<div/>', {
					'role': 'group',
					'class': 'btn-group'
				})
				.append(
					$('<a/>', {
						'class': 'btn btn-primary btn-sm logfiles_save',
						'title': _("Save")
					})
					.append( $('<i/>', { 'class': 'fa fa-floppy-o'}) )
				),
				$('<div/>', {
					'role': 'group',
					'class': 'btn-group'
				})
				.append(
					$('<a/>', {
						'class': 'btn btn-danger btn-sm logfiles_destory',
						'title': _("Remove")
					})
					.append( $('<i/>', { 'class': 'fa fa-trash'}) )
				)
			)
			.get(0).outerHTML;
}

function logfiles_cell_dropdown(value, row, index, field)
{
	var select = $('<select/>', { 'class': 'form-control', 'name': field });
	if (field == 'verbose') 
	{
		if ( is_Numeric(value) )
		{
			value = parseFloat(value);
			if (value >= 10 ) { value = 10; }
		}
		else
		{
			if (value == 'off') 	{ value = 0; }
			else if(value == 'on') 	{ value = 3; }
		}

		select.append(new Option('Off', 'off', (value == 0 ? true : false) ));
		select.append(new Option('On' , '3',   (value == 3 ? true : false) ));
		var i;
		for (i = 4; i <= 10; i++)
		{
			select.append(new Option(i, i, (value == i ? true : false) ));
		}
		select.append(new Option('*' , '*', (value == '*' ? true : false) ));
	}
	else
	{
		select.append(new Option('On' , 'on', (value == 'on' ? true : false) ));
		select.append(new Option('Off', '',   (value != 'on' ? true : false) ));
	}
	return select.get(0).outerHTML;

	// var html = '';
	// html += '<select class="form-control" name="' + field + '">';

	// if (field == 'verbose') 
	// {
	// 	if ( is_Numeric(value) )
	// 	{
	// 		value = parseFloat(value);
	// 		if (value >= 10 )
	// 		{
	// 			value = 10;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		if (value == 'off')
	// 		{
	// 			value = 0;
	// 		}
	// 		else if(value == 'on')
	// 		{
	// 			value = 3;
	// 		}
	// 	}

	// 	html += '<option value="off" ' + (value == 0 ? 'SELECTED' : '') + '>Off</option>';
	// 	html += '<option value="3"   ' + (value == 3 ? 'SELECTED' : '') + '>On</option>';
	// 	var i;
	// 	for (i = 4; i <= 10; i++)
	// 	{
	// 		html += '<option value="' + i + '" ' + (value == i ? 'SELECTED' : '') + '>' + i + '</option>';
	// 	}
	// 	html += '<option value="*" ' + (value == '*' ? 'SELECTED' : '') + '>*</option>';
	// }
	// else
	// {
	// 	html += '<option value="on" ' + (value == 'on' ? 'SELECTED' : '') + '>On</option>';
	// 	html += '<option value=""   ' + (value != 'on' ? 'SELECTED' : '') + '>Off</option>';
	// }

	// html += '</select>';
	// return html;
}

function logfiles_add_new_line(e) 
{
	e.preventDefault();
	$('#logfile_entries > tbody:last').each(function() 
	{
		var input = $('<input/>', { 'type': 'text', 'name': 'name', 'value': '', 'class': 'form-control'});
		$(this).find('tr:last').after(
			$('<tr/>', {})
			.append(
				$('<td/>', {'class': 'form-group'}).append( input ),
				$('<td/>', {}).html( logfiles_cell_dropdown('',	   null, null, 'debug') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('off', null, null, 'dtmf') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('',    null, null, 'error') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('off', null, null, 'fax') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('',    null, null, 'notice') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('',    null, null, 'verbose') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('',    null, null, 'warning') ),
				$('<td/>', {}).html( logfiles_cell_dropdown('off', null, null, 'security') ),
				$('<td/>', {})
				.append(
					$('<div/>', { 'role': 'group', 'class': 'btn-group btn-group-justified blocks'})
					.append(
						$('<div/>', { 'role': 'group', 'class': 'btn-group'})
						.append(
							$('<a/>', {'class': 'btn btn-success btn-sm logfiles_add_new', 'title': _("Create")})
							.append(
								$('<i/>', { 'class': 'fa fa-check'}),
							)
						),
						$('<div/>', { 'role': 'group', 'class': 'btn-group'})
						.append(
							$('<a/>', {'class': 'btn btn-danger btn-sm logfiles_add_cancel', 'title': _("Cancel")})
							.append(
								$('<i/>', { 'class': 'fa fa-times'}),
							)		
						),
					)
				)
			)	
		);
		input.focus();
	});
}

function logfiles_add_new(e) 
{
	var process = new logfiles_process(e);
	
	if ( ! process.checkId(false) )
	{
		process.errorFilename("Missing the name of the file!");
	}
	else
	{
		var post_data = {
			module: 'logfiles',
			command: 'logfiles_is_exist_file_name',
			namefile: process.getId()
		};
		$.post(window.FreePBX.ajaxurl, post_data, function(data) 
		{
			process.begin();
			process.setStatusAjax("AJAX_SEND_QUERY");
		})
		.done(function(data) 
		{
			if (data.status)
			{
				if (data.exist)
				{
					process.setStatusAjax("ERROR_FILENAME_EXIST");
					process.errorFilename(_("The name of the file is already in use!"));
				}
				else { process.setStatusAjax("DONE"); }
			}
			else
			{
				process.errorFilename( data.message ? data.message : _("Unknow error!") );
				process.setStatusAjax("STATUS_FAILED");
			}
		})
		.fail(function(err) { process.setStatusAjax("AJAX_ERROR"); })
		.always(function() 
		{
			if (process.getStatusAjax() == "DONE")
			{
				logfiles_save(e, true);
			}
			else { process.finish(); }
		});
	}
}

function logfiles_save(e, refres_all = false)
{
	var process = new logfiles_process(e);

	if ( ! process.checkId(false) )
	{
		process.errorFilename(_("Missing the name of the file!"));
	}
	else
	{
		var new_data = process.getControlsVal();
		var post_data = {
			module: 'logfiles',
			command: 'logfiles_set',
			namefile: process.getId(),
			data: JSON.stringify(new_data)
		};
		$.post(window.FreePBX.ajaxurl, post_data, function(data) 
		{
			process.begin();
			process.setStatusAjax("AJAX_SEND_QUERY");
		})
		.done(function(data)
		{
			fpbxToast(data.message, '', (data.status ? 'success' : 'error') );
			if (data.status)
			{
				if (refres_all) 
				{
					process.refreshTable();
				}
				process.setStatusAjax("DONE");
			}
			else { process.setStatusAjax("STATUS_FAILED"); }
		})
		.fail(function(err) { process.setStatusAjax("AJAX_ERROR"); })
		.always(function()
		{ 
			process.finish();
			if (process.getStatusAjax() == "DONE")
			{
				show_btn_apply_conf();
			}
		});
	}
}

function logfiles_destory(e)
{
	var process = new logfiles_process(e);

	if ( process.checkId(true) )
	{
		fpbxConfirm(
			sprintf(_('Are you confirming that you want to remove this file (%s)?'), process.getId() ),
			_("Yes"),_("No"),
			function()
			{
				var post_data = {
					module: 'logfiles',
					command: 'logfiles_destory',
					namefile: process.getId()
				};
				$.post(window.FreePBX.ajaxurl, post_data, function(data) 
				{
					process.begin();
					process.setStatusAjax("AJAX_SEND_QUERY");
				})
				.done(function(data) 
				{
					fpbxToast(data.message, '', (data.status ? 'success' : 'error') );
					if (data.status)
					{
						process.removeRow();
						process.setStatusAjax("DONE");
					} 
					else { process.setStatusAjax("STATUS_FAILED"); }
				})
				.fail(function(err) { process.setStatusAjax("AJAX_ERROR"); })
				.always(function()
				{
					process.finish();
					if (process.getStatusAjax() == "DONE")
					{
						show_btn_apply_conf();
					}
				});
			}
		);
	}
}

function logfiles_process(e)
{
	this.e 			 = e;
	this.status_ajax = null;
	this.status 	 = null;
	this.row 		 = $(e).closest('tr');
	this.table 		 = $(e).closest('table');
}

logfiles_process.prototype = {
	begin: function() 
	{
		if (this.status === true) { return; }
		this.disabledControlsRow(true);
		$(this.e).find('i').addClass("fa-spinner fa-spin");
		this.status = true;
	},
	finish: function() 
	{
		if (this.status === false) { return; }
		this.disabledControlsRow(false);
		$(this.e).find('i').removeClass("fa-spinner fa-spin");
		this.status = false;
	},
	setStatusAjax: function(new_status)
	{
		this.status_ajax = new_status;
	},
	getStatusAjax: function()
	{
		return this.status_ajax;
	},
	getTable: function()
	{
		return this.table;
	},
	refreshTable: function() 
	{
		this.getTable().bootstrapTable('refresh');
	},
	getRow: function()
	{
		return this.row;
	},
	removeRow: function(refres_all = true)
	{
		if (refres_all)
		{
			this.getTable().bootstrapTable('removeByUniqueId', this.getId() );
		}
		else 
		{
			var row = this.getRow();
			$(row).fadeOut('normal', function()
			{
				$(row).remove();
			});
		}
	},
	disabledControlsRow: function(new_status)
	{
		this.getRow().find('input, select, button').attr('disabled', new_status);
		if (new_status)
		{
			this.getRow().find('a.btn').addClass('disabled');
		}
		else
		{
			this.getRow().find('a.btn').removeClass('disabled');
		}
	},
	getId: function()
	{
		return $(this.getRow()).find('input[name="name"]').val();
	},
	getControlsVal: function()
	{	
		var data_return = {};
		this.getRow().find('input, select').each(function()
		{
			if ($(this).val())
			{
				data_return[$(this).attr('name')] = $(this).val();
			}
		});
		return data_return;
	},
	checkId: function(showmsg = true)
	{
		if (! this.getId())
		{
			if (showmsg)
			{
				fpbxToast(_("Name is not defined!"), '', 'error');
			}
			return false;
		}
		return true;
	},
	errorFilename: function(error_text)
	{
		if (error_text)
		{
			fpbxToast(error_text, '', 'error');
		}
		
		this.getRow().find('input[name="name"]').not("input[type='hidden']").closest('td').each(function() 
		{
			if (! $(this).hasClass("has-error") ) 
			{
				$(this).addClass("has-error has-feedback")
				.append(
					$("<span/>", { 'class': 'glyphicon glyphicon-remove form-control-feedback'})
				);
			}
		});
		
	}
}

/*
 * END > TAB - LOG_FILES
 */


/*
 * INIT > TAB - SETTINGS
 */

function settings_get_value(i, e)
{
	var process = new settings_process(e);
	var post_data = {
		module: 'logfiles',
		command: 'settings_get',
		setting: process.getName()
	};
	$.post(window.FreePBX.ajaxurl, post_data, function(data) 
	{
		if ( process.getType() != "text" )
		{
			process.displayUndo(false);
		}
		process.begin();
		process.setStatusAjax("AJAX_SEND_QUERY");
	})
	.done(function(data)
	{
		if (data.status)
		{
			process.setStatusAjax( process.setValue(data.value) ? "DONE" : "ERROR_SET_NEW_VALUE" );
		}
		else
		{
			process.setStatusAjax("STATUS_FAILED");
			fpbxToast(data.message, '', 'error');
		}
	})
	.fail(function(err) { process.setStatusAjax("AJAX_ERROR"); })
	.always(function()
	{
		process.finish();
		if (process.getStatusAjax() != "DONE")
		{
			process.displayUndo(true);
		}
	});
}

function settings_save(i, e) 
{
	var process = new settings_process(e);
	var post_data = {
		module: 'logfiles',
		command: 'settings_set',
		setting: process.getName(),
		val: process.getValue()
	};
	$.post(window.FreePBX.ajaxurl, post_data, function(data)
	{
		if ( process.getType() != "text" )
		{
			process.displayUndo(false);
		}
		process.begin();
		process.setStatusAjax("AJAX_SEND_QUERY");
	})
	.done(function(data)
	{
		process.setStatusAjax( data.status ? "DONE" : "STATUS_FAILED" );
		fpbxToast(data.message, '', (data.status ? 'success' : 'error') );
	})
	.fail(function(err) { process.setStatusAjax("AJAX_ERROR"); })
	.always(function()
	{
		process.finish();
		if (process.getStatusAjax() != "DONE")
		{
			settings_get_value(null, e);
		}
		else
		{
			show_btn_apply_conf();
		}
	});
}

function settings_process(e) 
{
	this.e 			 = e;
	this.status_ajax = null;
	this.status 	 = null;
	this.form 		 = $(e).closest('.form-group');
}

settings_process.prototype = {
	begin: function() 
	{
		if (this.status === true) { return; }
		this.disabledControls(true);
		// $(this.e).find('i').addClass("fa-spinner fa-spin");
		this.status = true;
	},
	finish: function() 
	{
		if (this.status === false) { return; }
		this.disabledControls(false);
		// $(this.e).find('i').removeClass("fa-spinner fa-spin");
		this.status = false;
	},
	setStatusAjax: function(new_status)
	{
		this.status_ajax = new_status;
	},
	getStatusAjax: function()
	{
		return this.status_ajax;
	},
	getForm: function()
	{
		return this.form;
	},
	getType: function()
	{
		return this.e.getAttribute('type');
	},
	getName: function()
	{
		return this.e.getAttribute('name');
	},
	getValue: function()
	{
		return $(this.e).val();
	},
	setValue: function(new_value)
	{
		switch (this.getType())
		{
			case 'text':
				$(this.e).val( new_value );
				break;

			case 'radio':
				$("input[value=" + new_value + "]", this.getForm()).prop('checked', true);
				break;
			
			default:
				console.log("Type input not implement!");
				return false;
		}
		return true;
	},
	disabledControls: function(new_status)
	{
		this.getForm().find('input, select, button').attr('disabled', new_status);
		if (new_status)
		{
			this.getForm().find('a.btn').addClass('disabled');
		}
		else
		{
			this.getForm().find('a.btn').removeClass('disabled');
		}
	},
	displayUndo: function(new_status)
	{
		if (new_status)
		{
			this.getForm().find('a.setting_realod').show();
		}
		else
		{
			this.getForm().find('a.setting_realod').hide();
		}
	}
}

/*
 * END > TAB - SETTINGS
 */
