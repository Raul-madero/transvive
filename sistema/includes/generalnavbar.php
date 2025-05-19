<?php
    switch(intval($_SESSION['rol'])) {
        case 1:
            include('includes/navbar.php');
            break;
        case 2:
            include('includes/navbaroperador.php');
            break;
        case 4:
            include('includes/navbarsup.php');
            break;
        case 5:
            include('includes/navbarrhuman.php');
            break;
        case 6:
            include('includes/navbaroperac.php');
            break;
        case 7:
            include('includes/navbarmantto.php');
            break;
        case 8:
            include('includes/navbarjefeoper.php');
            break;
        case 9:
            include('includes/navbargrcia.php');
            break;
        case 10:
            include('includes/navbaralmacen.php');
            break;
        case 14:
            include('includes/navbarcalidad.php');
            break;
        case 15:
            include('includes/navbarmonitorista.php');
            break;
        case 16:
            include('includes/navbarcompras.php');
            break;
        case 17:
            include('includes/navbarventas.php');
            break;
        case 18:
            include('includes/navbar.php');
            break;
        default:
            header('Location: ../index.php');
            break;
    }