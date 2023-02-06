<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TopScribe</title>
    <meta name="author" content="Taimur Rahman" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>


<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <?php
    include('function/constant.php');
    if(isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        echo "Welcome $name.";
    }
?>

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
<?php
    if(isset($_SESSION['name'])) {
        echo "<a href='function/logout.php' class='btn btn-primary'>Logout</a>";
    }else{
    ?>
    <form class="d-flex"  action="function/login.php" method="post">
        <input class="form-control me-2" type="text" maxlength="11" name="username" placeholder="Username" required>
        <input class="form-control me-2" type="password" name="password" placeholder="Password" required>
        
     <button class='btn btn-primary' type='submit'>Login</button>
     <a href='registration.php' class='btn btn-primary'>Register</a>
    </form>
    
<?php
}
if (isset($_GET['error'])){ 
    $error = $_GET['error'];
    echo "<span class='navbar-text error'> $error</span>";

}
?>




    </div>
  </div>
</nav>