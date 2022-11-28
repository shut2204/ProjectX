<?php
    session_start();
    require_once 'Modal/ConferenceDAO.php';

    $conf_dao = new \Database\ConferenceDAO();
    $all_conference = $conf_dao->getAll();
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
</head>
<body background="imgs/1.jfif">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="index.php">ProjectX</a>
</nav>

<br><br><br><br><br>

<div class="container">
    <a  href="Pages/create.html" class="mb-2 btn btn-outline-success">Add</a>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($all_conference as $key => $value) :?>
        <tr>
            <td><?php echo $value->getTitle();?></td>
            <td><?php echo $value->getDates();?></td>
            <td>
                <form style="display: inline-block"action="commands/details_record.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $value->getId();?>">
                    <button name="detail" type="submit" class="btn btn-outline-success">Details</button>
                </form>
                <form style="display: inline-block" action="commands/refactor_record.php" method="get">
                    <input type="hidden" name="id_ref" value="<?php echo $value->getId();?>">
                    <input type="hidden" name="command" value="site">
                    <button name="edit" type="submit" class="btn btn-outline-info">Edit</button>
                </form>
            </td>

            <form action="commands/Delete_record.php" method="post">
                <input type="hidden" name="id" value="<?php echo $value->getId();?>">
                <td>
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
