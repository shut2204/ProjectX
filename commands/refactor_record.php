<?php
    session_start();
    require_once '../Modal/ConferenceDAO.php';

    if (isset($_GET['command'])){

        $id = $_GET['id_ref'];
        $conf_dao = new \Database\ConferenceDAO();

        $conf = $conf_dao->getOneById($id);

        $_SESSION['conf_ref'] = $conf;

        unset($_GET['command']);

        header('Location: ../Pages/details_refactor.php');
    }else{
        $id = $_POST['id'];
        $title = $_POST['title'];
        $date = $_POST['date'];
        $country = $_POST['country'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        $conf_dao = new \Database\ConferenceDAO();

        if ($latitude == null || $longitude == null) {
            $latitude = $longitude = null;
        }

        $conf_dao->refactorRecord($id, $title, $date, $country, $latitude, $longitude);

        header('Location: ../index.php');
    }
exit;
