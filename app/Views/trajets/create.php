<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Créer un trajet</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/klaxon/trajets/create">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">Téléphone</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['telephone']) ?>" disabled>
        </div>
    </div>

    <hr class="my-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_depart" class="form-label">Agence de départ</label>
            <select class="form-select" id="id_agence_depart" name="id_agence_depart" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)($_POST['id_agence_depart'] ?? 0) === (int)$agence['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="gdh_depart" class="form-label">Date et heure de départ</label>
            <input type="datetime-local" class="form-control" id="gdh_depart" name="gdh_depart"
                   value="<?= htmlspecialchars($_POST['gdh_depart'] ?? '') ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_arrivee" class="form-label">Agence d'arrivée</label>
            <select class="form-select" id="id_agence_arrivee" name="id_agence_arrivee" required>
                <option value="">-- Choisir --</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)($_POST['id_agence_arrivee'] ?? 0) === (int)$agence['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="gdh_arrivee" class="form-label">Date et heure d'arrivée</label>
            <input type="datetime-local" class="form-control" id="gdh_arrivee" name="gdh_arrivee"
                   value="<?= htmlspecialchars($_POST['gdh_arrivee'] ?? '') ?>" required>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <label for="nb_places_total" class="form-label">Nombre de places</label>
            <input type="number" class="form-control" id="nb_places_total" name="nb_places_total"
                   min="1" max="20" value="<?= (int)($_POST['nb_places_total'] ?? 1) ?>" required>
        </div>
    </div>

    <button type="submit" class="btn btn-dark">Créer le trajet</button>
    <a href="/klaxon" class="btn btn-secondary ms-2">Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>