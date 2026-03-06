<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">Liste des utilisateurs</h2>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employes as $employe): ?>
            <tr>
                <td><?= htmlspecialchars($employe['nom']) ?></td>
                <td><?= htmlspecialchars($employe['prenom']) ?></td>
                <td><?= htmlspecialchars($employe['email']) ?></td>
                <td><?= htmlspecialchars($employe['telephone']) ?></td>
                <td><?= htmlspecialchars($employe['role']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>