<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Liste des trajets</h2>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Places</th>
            <th>Auteur</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trajets as $trajet): ?>
            <tr>
                <td><?= htmlspecialchars($trajet['agence_depart']) ?></td>
                <td><?= date('d/m/Y', strtotime($trajet['gdh_depart'])) ?></td>
                <td><?= date('H:i', strtotime($trajet['gdh_depart'])) ?></td>
                <td><?= htmlspecialchars($trajet['agence_arrivee']) ?></td>
                <td><?= date('d/m/Y', strtotime($trajet['gdh_arrivee'])) ?></td>
                <td><?= date('H:i', strtotime($trajet['gdh_arrivee'])) ?></td>
                <td><?= (int)$trajet['nb_places_disponibles'] ?></td>
                <td><?= htmlspecialchars($trajet['employe_prenom'] . ' ' . $trajet['employe_nom']) ?></td>
                <td>
                    <form method="POST"
                          action="/klaxon/admin/trajets/<?= (int)$trajet['id_trajet'] ?>/delete"
                          onsubmit="return confirm('Supprimer ce trajet ?')">
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>