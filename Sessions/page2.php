<?php
session_start();
if (isset($_SESSION['prenom'])) {
    echo 'Bonjour' . htmlspecialchars($_SESSION['prenom'], 'UTF-8'); 
} else {
    echo 'Bonjour Visiteur !';
}