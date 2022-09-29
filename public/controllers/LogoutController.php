<?php
require_once "../config/routes.php";

session_start();
session_destroy();

header("location: ".ROUTE_HOME);
