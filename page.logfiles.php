<?php

$display = $_REQUEST['display'];
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'tool';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

?>
</div>
<div class="content">
<?php

switch($action) {
	case 'showlog':
?>
		<h2>
			<?php echo sprintf(_('%s - last 2000 lines'),$amp_conf['ASTLOGDIR']."/full") ?>
		</h2>
		<a href="config.php?<?php echo "display=$display&type=$type&action=showlog"?>"><?php echo _("Redisplay Asterisk Full debug log (last 2000 lines)") ?></a><br>
		<hr><br>
		<?php
		system ('tail --line=2000 '.$amp_conf['ASTLOGDIR'].'/full | sed -e "s,<,\&lt;,g;s,>,\&gt;,g;s/$/<br>/"'); 
		break;

	default:
		echo "<h2>"._("Asterisk Log Files")."</h2>";
?>
				<a href="config.php?<?php echo "display=$display&type=$type&action=showlog"?>"><?php echo _("Display Asterisk Full debug log (last 2000 lines)") ?></a><br>
				<br><br><br><br><br><br><br><br><br><br><br><br>
<?php
    break;
}
?>
</div>
