<?php

session_start();

// Suppression des variables de session et de la session
session_destroy();

header('Location: index.php?page=home');
