<?php
$expire=time()+60*60*24*30;
setcookie("session", $newsid, $expire);
header("Location:/web/login.php?warnMsg=You've signed out.")
?>