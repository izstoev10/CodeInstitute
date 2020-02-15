<?php
// routing
// Get dirname, basename, extension, filename
$path_parts = pathinfo($_SERVER['SCRIPT_NAME']);

// Replace dirname from request url , so we get
// www.mywebsite.com/dirname/page -> www.mywebsite.com/myprojectName/page
$file = str_replace($path_parts['dirname'],'', $_SERVER['REQUEST_URI']);

// remove the / after the request
// www.mywebsite.com/page/ => www.mywebsite.com/page
$file = ltrim($file, '/');

// get everything after "?" sign
$stringQuery = $_SERVER['QUERY_STRING'];

if($stringQuery) {
    // Remove queryString from filename so
    // file = filename?query=rest ===> file = filename
    $file = str_replace('?'.$stringQuery , '', $file);

    // add queryString to GET
    parse_str($stringQuery, $_GET);
}
$file = str_replace('.php', '', $file);

// end of routing

// get http or https
$requestScheme = $_SERVER['REQUEST_SCHEME'] ?? 'https';
// get hostname
$requestHost = $_SERVER['SERVER_NAME'];

// Build url for the site so, every page start from this url
$url = $requestScheme . '://' . $requestHost . $path_parts['dirname'] . '/';
DEFINE('BASE_PATH', $url);
include 'config/config.php';
include 'config/connection.php';
//include 'helpers/functions.php';
//
//if(empty($_SESSION['logged']) && in_array($file, $logRequirePages)) {
//    // If user is not logged, but try to access logged required page redirect to login
//    redirect('login');
//}

include (file_exists('content/'.$file.'.php'))
    ? 'content/'.$file.'.php'
    : 'content/loguser.php';


?>