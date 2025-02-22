<?php
session_start();
session_destroy();

header("Location: /Event-Hive/Sign_in/signin.html");
exit;
?>
