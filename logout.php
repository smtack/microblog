<?php
require_once 'src/init.php';

$user->logOut($_SESSION['user']);

header('Location: index.php');