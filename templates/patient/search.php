<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2>Résultats de la recherche</h2>

<?php if (!empty($doctors)): ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Docteur</th>
            <th>Spécialité</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($doctors as $d): ?>
        <tr>
            <td>Dr <?= htmlspecialchars($d['nom'] . ' ' . $d['prenom']) ?></td>
            <td><?= htmlspecialchars($d['speciality']) ?></td>
            <td>
                <a href="index.php?action=creneaux&medecin_id=<?= $d['id'] ?>" class="btn btn-sm btn-primary">
                    Voir les créneaux
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>

<div class="alert alert-warning">
    Aucun médecin trouvé
</div>

<?php endif; ?>

<div class="mt-3">
    <a href="index.php?action=dashboard" class="btn btn-secondary">Retour au Dashboard</a>
</div>

</body>
</html>