<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h2>Espace Patient</h2>

    <div class="card p-3 mb-3">

        <h5> Rechercher un médecin</h5>

        <form method="GET" action="index.php">
            <input type="hidden" name="action" value="search">
            
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Nom médecin">
                </div>

                <div class="col-md-4">
                    <select name="specialty" class="form-control">
                        <option value="">-- Choisir spécialité --</option>
                        <?php if (!empty($specialites)): ?>
                            <?php foreach ($specialites as $s): ?>
                                <option value="<?= $s['id'] ?>">
                                    <?= htmlspecialchars($s['libelle']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

    </div>

    <div class="card p-3">

        <h5> Mes rendez-vous</h5>

        <?php if (!empty($appointments)): ?>

        <table class="table table-bordered">
            <tr>
                <th>Docteur</th>
                <th>Début créneau</th>
                <th>Fin créneau</th>
                <th>Date RDV</th>
                <th>Motif</th>
                <th>Statut</th>
                <th>Action</th> </tr>

            <?php foreach ($appointments as $a): ?>
                <tr>
                    <td>
                        Dr <?= htmlspecialchars($a['doctor_nom'] . ' ' . $a['doctor_prenom']) ?>
                    </td>

                    <td><?= $a['dateHeureDebut'] ?></td>
                    <td><?= $a['dateHeureFin'] ?></td>

                    <td><?= $a['date_heure'] ?></td>
                    <td><?= $a['motif'] ?></td>
                    <td>
                        <span class="badge bg-<?= $a['statut'] == 'EN_ATTENTE' ? 'warning text-dark' : 'success' ?>">
                            <?= $a['statut'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="index.php?action=ordonnance&id=<?= $a['id'] ?>" class="btn btn-sm btn-info text-white">
                            Voir Ordonnance
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

        <?php else: ?>

        <div class="alert alert-warning">
            Aucun rendez-vous trouvé
        </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>