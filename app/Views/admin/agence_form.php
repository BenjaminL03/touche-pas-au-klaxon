<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4"><?= isset($agence) ? 'Modifier' : 'Ajouter' ?> une agence</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?= isset($agence)
    ? '/klaxon/admin/agences/' . (int)$agence['id_agence'] . '/edit'
    : '/klaxon/admin/agences/create' ?>">
    <div class="mb-3 col-md-4">
        <label for="nom" class="form-label">Nom de l'agence</label>
        <input type="text" class="form-control" id="nom" name="nom"
               value="<?= htmlspecialchars($agence['nom'] ?? $_POST['nom'] ?? '') ?>"
               required autofocus>
    </div>
    <button type="submit" class="btn btn-dark">Enregistrer</button>
    <a href="/klaxon/admin/agences" class="btn btn-secondary ms-2">Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>