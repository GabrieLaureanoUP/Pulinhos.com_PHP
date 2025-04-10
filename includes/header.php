<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title><?php echo SITE_NAME; ?> - Guia Completo de Raças</title>
    <meta name="description" content="Descubra as diferentes raças de coelhos domésticos e selvagens, suas características, comportamentos e cuidados específicos.">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>    <header class="mb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><?php echo SITE_NAME; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="filtrar.php"><i class="fas fa-search"></i> Encontrar Raças</a>
                        </li>                        <li class="nav-item">
                            <a class="nav-link" href="guia_cuidados.php"><i class="fas fa-book"></i> Guia de Cuidados</a>
                        </li>
                    </ul>                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="protegido.php"><i class="fas fa-lock"></i> Área Restrita</a>
                        </li>
                        <?php if(isset($_SESSION['logado']) && $_SESSION['logado']): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">