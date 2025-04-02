<?php

function isLoggedOn() {
    session_start();
    return isset($_SESSION['user']);
}

function getLoggedUser() {
    session_start();
    return $_SESSION['user'] ?? null;
}
