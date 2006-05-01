<?php

$display=$_REQUEST['display'];

switch($display) {
	default:
		
		echo "<h2>Asterisk Log Files</h2>";
        include 'logfiles.php';

    break;
	    
}
?>

</div>
