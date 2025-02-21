<?php
session_start();
session_destroy();

header("Location: /ep/Sign_in/signin.html");
exit;
?>
