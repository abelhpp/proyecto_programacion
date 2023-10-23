<?php
ini_set('session.gc_maxlifetime', $session_lifetime);$session_lifetime = 1800; // 30 minutos en segundos
ini_set('session.gc_maxlifetime', $session_lifetime);
session_start();

require_once 'controllers/activarController.php';
include 'views/activar.php';