<!DOCTYPE html>
<html>
<head>
    <title>Ordonnance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2> Ordonnance</h2>

<?php if ($ord): ?>

<div class="alert alert-info">
    <?= $ord['contenuTexte'] ?>
</div>

<?php else: ?>

<div class="alert alert-warning">
    Aucune ordonnance
</div>

<?php endif; ?>

</body>
</html>