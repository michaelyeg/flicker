<?php

unset($_COOKIE['login']);
setCookie('login',null, time()-3600);
header('location:index.php');
