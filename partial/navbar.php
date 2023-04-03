<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TopScribe</title>
    <meta name="author" content="Taimur Rahman" />
    <link rel="stylesheet" href="css/dragula.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
<!--simpleMDE-->
    <link rel="stylesheet" href="css/simplemde.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Cormorant+Garamond&family=Lobster&family=Taviraj&display=swap" rel="stylesheet">
    

</head>
   
<nav class="navbar navbar-expand-lg bg-primary navbar-dark nav-height">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="images/logo.svg" alt="Logo" class="d-inline-block align-text-top filter-white">

    <?php
    include('function/constant.php');
    if(isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $id = $_SESSION['id'];
        echo "Welcome $name.";
    }
?>

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <?php if(!isset($_SESSION['name'])){?>
        <!--guest view-->
        <li><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li><a class="nav-link" aria-current="page" href="editor.php">Editor</a></li>
            <li><a class="nav-link" aria-current="page" href="browse.php">Browse</a></li>
            <?php }else if($_SESSION['id'] != 0){ ?>
                <!--user view-->
            <li><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
            <li><a class="nav-link" aria-current="page" href="editor.php">Editor</a></li>
            <li><a class="nav-link" aria-current="page" href="browse.php">Browse</a></li>
            <li><a class="nav-link" aria-current="page" href="discover.php">Create</a></li>
            <li><a class="nav-link" aria-current="page" href="contacts.php">Contacts</a></li>
            <li><a class="nav-link" aria-current="page" href="users.php">Users</a></li>
            <?php }else{?>
                <!--admin view-->
                <h1>admin</h1>
            <?php }?>
        </ul>
    
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