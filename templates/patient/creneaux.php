<!DOCTYPE html>
<html>
<head>
    <title>Creneaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2>Creneaux disponibles</h2>

<table class="table table-bordered">

<tr>
    <th>Heure début</th>
    <th>Heure fin</th>
    <th>Action</th>
</tr>

<?php foreach ($creneaux as $c): ?>

<tr>
    <td><?= $c['dateHeureDebut'] ?></td>
    <td><?= $c['dateHeureFin'] ?></td>
    <td>
        <a href="index.php?action=book&creneau_id=<?= $c['id'] ?>" class="btn btn-success">
            Réserver
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>