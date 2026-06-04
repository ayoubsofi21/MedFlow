<?php

$page = $_GET['page'] ?? 'search';

switch ($page)
{
    case 'search':
        require_once '../templates/patient/search.php';
        break;

    default:
        echo "Page not found";
}