<?php
    require_once '../Modal/ConferenceDAO.php';

    $id = $_POST['id'];
    $conf_dao = new \Database\ConferenceDAO();

    $conf_dao->removeRecord($id);

    header('Location: ../index.php');
    exit;