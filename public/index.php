<?php

$page = $_GET['page'] ?? 'admin-dashboard';

require '../templates/layout/header.php';
?>

<div class="flex">

    <?php
    //  require '../templates/layout/sidebar.php';
      ?>

    <main class="flex-1 p-8">

        <?php

        switch ($page) {

            case 'admin-dashboard':
                require '../templates/admin/dashboard.php';
                break;

            case 'doctors':
                require '../templates/admin/doctors.php';
                break;

            case 'specialties':
                require '../templates/admin/specialties.php';
                break;

            case 'patient-dashboard':
                require '../templates/patient/dashboard.php';
                break;

            case 'search':
                require '../templates/patient/search.php';
                break;

            case 'agenda':
                require '../templates/doctor/agenda.php';
                break;

            default:
                echo "<h1>404 Page Not Found</h1>";
        }

        ?>

    </main>

</div>

<?php
require '../templates/layout/footer.php';
?>