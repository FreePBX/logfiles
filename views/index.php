<?php

	echo "<h2>"._("Asterisk Log Files")."</h2>";
?>
			<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<?php echo _('Display Asterisk Full debug log. How many lines would you like to display?')?><br>
			<input type="hidden" name="action" value="showlog">
			<input type="text" name="lines" value="500">
			<input type="submit" value="<?php echo _('View log');?>" />
			</form>
			<br><br><br><br><br><br><br><br><br><br><br><br>