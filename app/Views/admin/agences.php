<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des agences</h2>
    <a href="/klaxon/admin/agences/create" class="btn btn-dark">Ajouter une agence</a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($agences as $agence): ?>
            <tr>
                <td><?= htmlspecialchars($agence['nom']) ?></td>
                <td class="text-nowrap">
                    <a href="/klaxon/admin/agences/<?= (int)$agence['id_agence'] ?>/edit"
                       class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form method="POST"
                          action="/klaxon/admin/agences/<?= (int)$agence['id_agence'] ?>/delete"
                          style="display:inline"
                          onsubmit="return confirm('Supprimer cette agence ?')">
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