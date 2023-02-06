<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TopScribe</title>
    <meta name="author" content="Taimur Rahman" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class='bg-primary text-white '>


<div class='container' style="margin-top: 5%;">
    <div class="mb-3">
        <h1 style="color: rgba(var(--bs-white-rgb),var(--bs-text-opacity)) !important;">Registration</h1>
        <?php if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php }?>
        <form action="function/register.php" method="post">
            <label class='form-label mt-4'>Username</label>
            <input class='form-control' id='username' type="text" maxlength="11" name="username" placeholder="Username" onchange='checkUser()' required><br>
            <div id='feedback'></div>
            <label class='form-label mt-4'>Password</label>
            <input class='form-control' type="password" name="password" placeholder="Password" required><br>
            <label class='form-label mt-4'>Confirm Password</label>
            <input class='form-control' type="password" name="c_password" placeholder="Confirm Password" required><br>
            <button type="submit" class='btn btn-dark'>Register</button>
            <a href='index.php' class='btn btn-dark'>Back</a>
        </form>
    </div>
</div>



<script type="text/javascript" src="script.js"></script>
</body>