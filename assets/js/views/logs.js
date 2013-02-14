$(document).ready(function(){
	//load a lof file on browse if were not looking at the settings page
	if (!$.urlParam('view')) {
		get_lines(500);
	}
	
	$('#show').click(function(){
		get_lines($('#lines').val());
	});
	
	$('select[name=logfile], #lines').change(function(){
		get_lines($('#lines').val());
	});
});

function get_lines(lines) {
	//hacky way to "position" #log_view below #logfiles_header
	space = '<br /><br /><br /><br /><br /><br /><br />';
	$.get(window.location.href, {'lines': lines, 'logfile': $('select[name=logfile]').val()}, function(data){
		$('#log_view').html(space + data);
	})
}