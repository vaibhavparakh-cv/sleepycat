<?php
    include('../index.php');
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Sleepycat</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo BASE_URL . 'views/logout.php' ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
</nav>
  
<div class="container">
  <h3>User Details</h3>
  <p>Name: <?php echo $userDetails['first_name'] . ' ' . $userDetails['last_name'] ?> </p>
  <p>Email: <?php echo $userDetails['email'] ?> </p>
  <p>Created At: <?php echo date('d-m-Y', strtotime($userDetails['created_at'])) ?> </p>
</div>
<?php
    include('../includes/footer.php');
?>