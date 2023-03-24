<?php
# Database Connections
define("DB_SERVER", "localhost"); # Database server veebi leht jookseb samas kohas kus andmebaas
define("DB_USER", "marekreimal"); # username
define("DB_PASS", "Veeb1Andm"); # Password (panniga :))
define("DB_NAME", "marekreimal_crud"); # Database name with username!!

# Nice URL
# mis kaustas  on, siin on aadressi töötlus
$script_folder = '/tak22_crud_default/'; # NB .htaccess, vajalik et browseri realt saaks andmed kätte
$request = str_replace($script_folder, '/', $_SERVER['REQUEST_URI']); # see aadress mis saadakse selle eest võetakse kaldkriips
$request = substr($request, 1, strlen($request)); // remove first /
$req = explode('/', $request); // split from
# Max Per Page mitu kirjet lehel näitab
define('MAXPERPAGE', 4);
