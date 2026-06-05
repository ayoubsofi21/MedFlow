<?php

require "../../config/database.php";
require "../../src/Repository/UserRepository.php";
require "../../src/Controller/AuthController.php";

$auth = new AuthController(new UserRepository($conn));
$auth->logout();