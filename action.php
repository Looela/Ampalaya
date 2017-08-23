<?php
$command = escapeshellcmd('/Users/C3P/AppData/Local/Programs/Python/ampalaya files/bitterbitteran.py');
$output = shell_exec($command);
echo $output;
if ($output == 1)  
	{echo "Ikaý Mapait! Mamumunga Ka!";}
else 
	{echo "Ang Bitter Mo... Hanggang dahon ka nalang.";} 
?>