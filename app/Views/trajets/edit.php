<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Modifier un trajet</h2>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/klaxon/trajets/<?= (int)$trajet['id_trajet'] ?>/edit">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_depart" class="form-label">Agence de départ</label>
            <select class="form-select" id="id_agence_depart" name="id_agence_depart" required>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)($trajet['id_agence_depart']) === (int)$agence['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="gdh_depart" class="form-label">Date et heure de départ</label>
            <input type="datetime-local" class="form-control" id="gdh_depart" name="gdh_depart"
                   value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_depart'])) ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_agence_arrivee" class="form-label">Agence d'arrivée</label>
            <select class="form-select" id="id_agence_arrivee" name="id_agence_arrivee" required>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id_agence'] ?>"
                        <?= (int)($trajet['id_agence_arrivee']) === (int)$agence['id_agence'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="gdh_arrivee" class="form-label">Date et heure d'arrivée</label>
            <input type="datetime-local" class="form-control" id="gdh_arrivee" name="gdh_arrivee"
                   value="<?= date('Y-m-d\TH:i', strtotime($trajet['gdh_arrivee'])) ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label for="nb_places_total" class="form-label">Nombre total de places</label>
            <input type="number" class="form-control" id="nb_places_total" name="nb_places_total"
                   min="1" max="20" value="<?= (int)$trajet['nb_places_total'] ?>" required>
        </div>
        <div class="col-md-3">
            <label for="nb_places_disponibles" class="form-label">Places disponibles</label>
            <input type="number" class="form-control" id="nb_places_disponibles" name="nb_places_disponibles"
                   min="0" max="<?= (int)$trajet['nb_places_total'] ?>"
                   value="<?= (int)$trajet['nb_places_disponibles'] ?>" required>
        </div>
    </div>

    <button type="submit" class="btn btn-dark">Enregistrer</button>
    <a href="/klaxon" class="btn btn-secondary ms-2">Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>