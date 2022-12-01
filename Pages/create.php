<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ProjectX</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/air-datepicker.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="../js/air-datepicker.js"></script>
  <script src="../js/create1.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfLH8M8QJE_ZYW3W0R4Tw46Uyvh2dCKZM&callback=initMap&libraries=places" defer></script>
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
        <div class="card-header">Create conversation
        </div>
        <form action="../commands/create_record.php" method="post">
            <div class="card-body">
                <span>*Name</span>
                <input class="mb-2 form-control" id="title" name="title" type="text" placeholder="Title" required
                pattern=".{2,255}" title="Please input text of range from 2 to 255">

                <label for="airdatepicker">*Date:</label>
                <input type="text" name="date" id="airdatepicker" class="form-control-sm" required
                       pattern="\d{4}-\d\d-\d\d \d\d:\d\d(:\d\d)?" title="Please input like 2022-11-30 15:00">
                <br>
                <label for="sel1">*Country:</label>
                <select name="country" class="form-control" id="sel1" required>
                    <option value="1">Ukraine</option>
                    <option value="11">USA</option>
                    <option value="21">Canada</option>
                    <option value="31">Philippines</option>
                </select>
                <p class="mb-0">Address :</p>
                <span>Latitude</span>
                <input class="inp" type="text" id="lat" name="latitude" value=""
                       pattern="[+-]?\d+\.?\d*" title="Only digit or dots">

                <span>Longitude</span>
                <input class="inp" type="text" id="lng" name="longitude" value=""
                       pattern="[+-]?\d+\.?\d*" title="Only digit and dots">
                <span>Search:</span>
                <input type="text" id="search">
                <br><br>

                <div id="map"></div>


            </div>
            <div class="card-footer">
                <a href="../index.php" type="button" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
    new AirDatepicker('#airdatepicker',{
        minDate: new Date(),
        timepicker: true,
        minHours: 0,
        maxHours: 23,
        dateFormat: 'yyyy-MM-dd'
    });

</script>
<script>
    let title = document.getElementById('title');
    let regTitle = new RegExp(".{2,255}");

    title.oninput = function () {
        if (this.value.match(regTitle)){
            this.classList.remove('is-invalid');
            this.classList.add('is-valid')
        }else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    }
</script>
</body>
</html>