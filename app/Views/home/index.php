<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if (!isset($_SESSION['user'])): ?>
    <p class="text-muted mb-3">
        Pour obtenir plus d'informations sur un trajet, veuillez vous connecter.
    </p>
<?php endif; ?>

<h2 class="mb-3">Trajets proposés</h2>

<?php if (empty($trajets)): ?>
    <p class="text-muted">Aucun trajet disponible pour le moment.</p>
<?php else: ?>
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
                <?php if (isset($_SESSION['user'])): ?>
                    <th></th>
                <?php endif; ?>
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

                    <?php if (isset($_SESSION['user'])): ?>
                    <td class="text-nowrap">
                        <!-- Bouton détails (modale) -->
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-<?= $trajet['id_trajet'] ?>">
                            <i class="bi bi-eye"></i>
                        </button>

                        <?php if ($_SESSION['user']['id'] === (int)$trajet['id_employe']): ?>
                            <!-- Modifier -->
                            <a href="/klaxon/trajets/<?= $trajet['id_trajet'] ?>/edit"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <!-- Supprimer -->
                            <form method="POST" action="/klaxon/trajets/<?= $trajet['id_trajet'] ?>/delete"
                                  style="display:inline"
                                  onsubmit="return confirm('Supprimer ce trajet ?')">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>

                <?php if (isset($_SESSION['user'])): ?>
                <!-- Modale détails -->
                <div class="modal fade" id="modal-<?= $trajet['id_trajet'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Auteur :</strong> <?= htmlspecialchars($trajet['employe_prenom'] . ' ' . $trajet['employe_nom']) ?></p>
                                <p><strong>Téléphone :</strong> <?= htmlspecialchars($trajet['employe_telephone']) ?></p>
                                <p><strong>Email :</strong> <?= htmlspecialchars($trajet['employe_email']) ?></p>
                                <p><strong>Nombre total de places :</strong> <?= (int)$trajet['nb_places_total'] ?></p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>