<?php

require("middlewares/common_middleware.php");
require("middlewares/security_middleware.php");
require("middlewares/session_middleware.php");

method_not_allowed();
$msg = json_encode($_SERVER);
echo $msg;
exit;
