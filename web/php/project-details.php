<?php

// Include the database connection file

include('db.php');

// Check if project ID is set

if(isset($_GET['id'])) {

  // Get project details from database

  $id = $_GET['id'];

  $query = "SELECT * FROM projects WHERE id = $id";

  $result = mysqli_query($conn, $query);

  $project = mysqli_fetch_assoc($result);

  

  // Check if project exists

  if(!$project) {

    echo 'Project not found.';

    exit;

  }

} else {

  echo 'Project ID not provided.';

  exit;

}

?>

<!DOCTYPE html>

<html>

<head>

  <title>Proactive Web App - Project Details</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

  <link rel="stylesheet" type="text/css" href="css/fontawesome-all.css">

  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">

  <link rel="stylesheet" type="text/css" href="css/styles.css">

  <link rel="stylesheet" type="text/css" href="css/swiper.css">

</head>

<body>

  <!-- Header -->

  <?php include('header.php'); ?>

  <!-- Page Content -->

  <div class="container">

    <h1><?php echo $project['title']; ?></h1>

    <p><?php echo $project['description']; ?></p>

    <p>Start Date: <?php echo $project['start_date']; ?></p>

    <p>End Date: <?php echo $project['end_date']; ?></p>

    <p>Status: <?php echo $project['status']; ?></p>

  </div>

  <!-- Footer -->

  <?php include('footer.php'); ?>

  <!-- Scripts -->

  <script src="js/jquery.min.js"></script>

  <script src="js/popper.min.js"></script>

  <script src="js/bootstrap.min.js"></script>

  <script src="js/jquery.easing.min.js"></script>

  <script src="js/jquery.magnific-popup.js"></script>

  <script src="js/swiper.min.js"></script>

  <script src="js/scripts.js"></script>

</body>

</html>

