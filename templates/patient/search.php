<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2> Doctors Results</h2>

<?php if (!empty($doctors)): ?>

<table class="table table-bordered">

    <tr>
        <th>Name</th>
        <th>Speciality</th>
    </tr>

    <?php foreach ($doctors as $d): ?>
        <tr>
            <td><?= $d['nom'] . ' ' . $d['prenom'] ?></td>
            <td><?= $d['speciality'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php else: ?>

<div class="alert alert-warning">
    No doctors found 
</div>

<?php endif; ?>



</body>
</html>