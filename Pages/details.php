<?php
require_once '../Modal/ConferenceDAO.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ProjectX</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/style_map.css">
</head>
<body background="../imgs/1.jfif">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="../index.php">ProjectX</a>
</nav>

<br><br><br><br><br>
<div class="container">
    <div class="card">
        <?php if (isset($_SESSION['conf'])):?>
        <div class="card-header"><?php echo $_SESSION['conf']->getTitle(); ?></div>
        <div class="card-body">
            <p>Date : <?php echo $_SESSION['conf']->getDates(); ?></p>
            <p>Country : <?php echo $_SESSION['conf']->getCountry(); ?></p>
            <?php if ($_SESSION['conf']->getLatitude() != null):?>
            <p>Address :</p>
            <span>Latitude:</span>
            <input disabled class="mb-2" value="<?php echo $_SESSION['conf']->getLatitude(); ?>" id="lat">
            <span>Longitude:</span>
            <input disabled class="mb-2" value="<?php echo $_SESSION['conf']->getLongitude(); ?>" id="lng">
            <div id="map"></div>
            <?php endif; ?>

        </div>

        <div class="card-footer">
            <form action="../commands/Delete_record.php" method="post">
                <a href="../index.php" type="button" class="btn btn-primary">Back</a>
                <input type="hidden" name="id" value="<?php echo $_SESSION['conf']->getId();?>">
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
        <?php endif; ?>
        <?php if (!isset($_SESSION['conf'])):?>
        <div class="card-footer">
            <a href="../index.php" type="button" class="btn btn-primary">Back</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfLH8M8QJE_ZYW3W0R4Tw46Uyvh2dCKZM&callback=initMap&v=weekly"
      defer
></script>
<script src="../js/detail.js"></script>
</body>
</html>