<?php
    session_start();
    require_once '../Modal/ConferenceDAO.php';

    $id = $_GET['id'];
    $conf_dao = new \Database\ConferenceDAO();

    $conf = $conf_dao->getOneById($id);

    echo $conf->getTitle();
    if ($conf === []){
        $_SESSION['ERROR'] = "Not found sorry";
    }else{
        $_SESSION['conf'] = $conf;
    }

    header('Location: ../Pages/details.php');
    exit;