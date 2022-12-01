<?php
    session_start();
    require_once '../Modal/ConferenceDAO.php';
    require_once  '../service/Validate.php';

    $title = $_POST['title'];
    $date = $_POST['date'];
    $country = $_POST['country'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (!\service\Validate::validateName($title) || !\service\Validate::validateDate($date)
        || !\service\Validate::validateDouble($latitude,$longitude)){
        $_SESSION['ERROR_CREATE'] = 'Incorrect data, please enter correct values';
        header('Location: ../Pages/create.php');
        exit();
    }else{
        unset($_SESSION['ERROR_CREATE']);
    }


    $conf_dao = new \Database\ConferenceDAO();
    if ($latitude == null || $longitude == null){
        $conf_dao->createRecordWithoutAddress($title, $date, $country);
    }else{
        $conf_dao->createRecord($title, $date, $country, $latitude, $longitude);
    }
    header('Location: ../index.php');
    exit;
