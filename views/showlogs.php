<h2><?php echo sprintf(_('%s - last %s lines'), $log_path, $lines) ?></h2>
<a href="config.php?<?php echo "display=$display&type=$type&action=showlog&lines=$lines"?>"><?php echo sprintf(_('Redisplay Asterisk Full debug log (last %s lines)'),$lines) ?></a><br>
<hr><br>
<?php
exec('tail -n'.$lines.' '. $log_path .' | sed -e "s,<,\&lt;,g;s,>,\&gt;,g;s/$/<br>/"',$log);
echo '<div class="pre">';
foreach($log as $l){
	if (strpos($l, 'WARNING')) {
		$l = '<span class="orange">'.$l.'</span>';
	}
	if (strpos($l, 'DEBUG')) {
		$l = '<span class="green">'.$l.'</span>';
	}
	if (strpos($l, 'NOTICE')) {
		$l = '<span class="blue">'.$l.'</span>';
	}
	if (strpos($l, 'ERROR')) {
		$l = '<span class="red">'.$l.'</span>';
	}
	//$l = str_replace(array_keys($color), $color, $l);

	echo logfiles_highlight_asterisk($l);
}
echo '</div>';
?>