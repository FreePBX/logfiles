<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>/var/log/asterisk/full - last 2000 lines</title>
</head>

<body>
<b>/var/log/asterisk/full - last 2000 lines</b>
<hr>
<br>
<?
echo system ('tail --line=2000 /var/log/asterisk/full | sed -e "s/$/<br>/"'); 
?>

</body>
</html>
