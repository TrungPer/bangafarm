<?php
include './Facebook/autoload.php';
include('./fbconfig.php');
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://localhost:3000/fb-callback.php', $permissions);
?>