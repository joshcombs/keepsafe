<?php
$connect_error = 'Sorry, we\'re experiencing connection issues';
mysql_connect('localhost', 'root', 'joshua11') or die($connect_error);
mysql_select_db('keepsafe') or die($connect_error);
?>