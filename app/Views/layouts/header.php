<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche Pas au Klaxon</title>
    <link href="/klaxon/public/css/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <!-- Admin -->
            <a class="navbar-brand" href="/klaxon/admin">Touche pas au klaxon</a>
            <div class="d-flex align-items-center gap-2">
                <a href="/klaxon/admin/employes" class="btn btn-secondary">Utilisateurs</a>
                <a href="/klaxon/admin/agences"  class="btn btn-secondary">Agences</a>
                <a href="/klaxon/admin/trajets"  class="btn btn-secondary">Trajets</a>
                <span class="text-white">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></span>
                <a href="/klaxon/logout" class="btn btn-light">Déconnexion</a>
            </div>

        <?php elseif (isset($_SESSION['user'])): ?>
            <!-- Employé connecté -->
            <a class="navbar-brand" href="/klaxon">Touche pas au klaxon</a>
            <div class="d-flex align-items-center gap-2">
                <a href="/klaxon/trajets/create" class="btn btn-secondary">Créer un trajet</a>
                <span class="text-white">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></span>
                <a href="/klaxon/logout" class="btn btn-light">Déconnexion</a>
            </div>

        <?php else: ?>
            <!-- Visiteur -->
            <a class="navbar-brand" href="/klaxon">Touche pas au klaxon</a>
            <div class="d-flex">
                <a href="/klaxon/login" class="btn btn-light">Connexion</a>
            </div>
        <?php endif; ?>

    </div>
</nav>

<div class="container">

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-secondary">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>