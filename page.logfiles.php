<?php

$display = $_REQUEST['display'];
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'tool';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$lines=isset($_REQUEST['lines'])?ereg_replace("[^0-9]", "",$_REQUEST['lines']):'';

?>
</div>
<div class="content">
<?php
if(!$lines){$action='';}//promts for lines if its not set
switch($action) {
	case 'showlog':
	$color = array(
	chr(27).'[0;33;40m' => '<span class="brown">',
	chr(27).'[0;36;40m' => '<span class="cyan">',
	chr(27).'[1;30;40m' => '<span class="black">',
	chr(27).'[1;31;40m' => '<span class="red">',
	chr(27).'[1;32;40m' => '<span class="green">',
	chr(27).'[1;33;40m' => '<span class="yellow">',
  chr(27).'[1;34;40m' => '<span class="blue">',
  chr(27).'[1;35;40m' => '<span class="magenta">',
  chr(27).'[1;36;40m' => '<span class="cyan">',
  chr(27).'[0;37;40m' => '<span class="black">',//this should really be white - but that would leave text unreadable on the white background of the page
  
	chr(27).'[1;40m' => '<span class="bold">',
	chr(27).'[4;40m' => '<span class="underline">',
  
	chr(27).'[0;40m'   => '</span>',
);
?>	
		<style type="text/css">
		.brown{color:brown;}
		.cyan{color:cyan;}
		.black{color:black;}
		.red{color:red;}
		.orange{color:orange;}
		.green{color:green;}
		.yellow{color:yellow;}
	  .blue{color:blue;}
	  .magenta{color:magenta;}
	  .cyan{color:cyan;}
	  .white{color:white;}
	  .bold{font-weight: bold;}
	  .underline{text-decoration:underline;}
	  .pre{font-family:"Courier New", Courier, monospace;font-size:0.85em}
		</style>
		<h2>
			<?php echo sprintf(_('%s - last %s lines'),$amp_conf['ASTLOGDIR']."/full",$lines) ?>
		</h2>
		<a href="config.php?<?php echo "display=$display&type=$type&action=showlog&lines=$lines"?>"><?php echo sprintf(_('Redisplay Asterisk Full debug log (last %s lines)'),$lines) ?></a><br>
		<hr><br>
		<?php
			exec('tail -n'.$lines.' '.$amp_conf['ASTLOGDIR'].'/full | sed -e "s,<,\&lt;,g;s,>,\&gt;,g;s/$/<br>/"',$log);
			echo '<div class="pre">';
			foreach($log as $l){
				if(strpos($l, 'WARNING')){$l='<span class="orange">'.$l.'</span>';}
				if(strpos($l, 'DEBUG')){$l='<span class="green">'.$l.'</span>';}
				if(strpos($l, 'NOTICE')){$l='<span class="blue">'.$l.'</span>';}
				if(strpos($l, 'ERROR')){$l='<span class="red">'.$l.'</span>';}
				$l=str_replace(array_keys($color), $color, $l);
				echo $l;
			}
echo '</div>';
		break;

	default:
		echo "<h2>"._("Asterisk Log Files")."</h2>";
?>
				<form action="config.php?<?php echo "display=$display&type=$type&action=showlog"?>" method="post">
				<?php echo _('Display Asterisk Full debug log. How many lines would you like to display?')?><br>
				<input type="text" name="lines" value="500">
				<input type="submit" value="<?php echo _('View log');?>" />
				</form>
				<br><br><br><br><br><br><br><br><br><br><br><br>
<?php
    break;
}
?>
