<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once 'config/Config.php';

require_once 'models/User.php';
require_once 'models/Post.php';

require_once 'routes/userRoute.php';
require_once 'routes/postRoute.php';


?>