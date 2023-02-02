<?php

// Logout user
session_start();
session_unset();
session_destroy();

// Back to home page
header("location: ../index.php");