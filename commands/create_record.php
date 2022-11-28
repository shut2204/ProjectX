<?php
    require_once '../Modal/ConferenceDAO.php';

    $title = $_POST['title'];
    $date = $_POST['date'];
    $country = $_POST['country'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $conf_dao = new \Database\ConferenceDAO();
    if ($latitude == null || $longitude == null){
        $conf_dao->createRecordWithoutAddress($title, $date, $country);
    }else{
        $conf_dao->createRecord($title, $date, $country, $latitude, $longitude);
    }
    header('Location: ../index.php');
    exit;
