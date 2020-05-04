$(document).ready(function(){
	//load a lof file on browse if were not looking at the settings page
	if (!$.urlParam('view')) {
		log_view_resize();
		get_lines(500);
	}

	$('#show').click(function(){
		get_lines($('#lines').val());
	});

	$('select[name=logfile], #lines').change(function(){
		get_lines($('#lines').val());
	});

	$(window).resize(function() {
		log_view_resize();
	});
});

function log_view_resize(){
	//TODO: It would be good if this works if the offset.top of #logfiles_navbar changed, but jquery does not
	//		detect the offset change, you would have to create a timer that would monitor the offset every x time.

	$('#log_view.pre').css('max-height',($(window).height() - $('#footer').height() - $('div.logfiles_header').height() - $('div.logfiles_header').offset().top));
}

function get_lines(lines) {
	$('#show').prop("disabled",true);
	var txt = _("Loading...");
	$('#show').text(txt);
	$('#log_view').html(txt);
	$.get(window.location.href, {'lines': lines, 'logfile': $('select[name=logfile]').val(), filter: $('#filter').val()}, function(data){
		$('#log_view').html(data);
		$('#show').prop("disabled",false);
		$('#show').text(_("Show"));
	})
}
