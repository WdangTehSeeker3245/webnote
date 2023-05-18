<?php
 #delete this file when you hosting..
 $app_pass = 'AppFaizalCobaN77';
 $passwordHashed = password_hash($app_pass, PASSWORD_BCRYPT);

 echo $passwordHashed;