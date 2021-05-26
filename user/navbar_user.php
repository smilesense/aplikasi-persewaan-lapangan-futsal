<html>
<head>
<a href="#" class="navbar-brand mx-auto" style="display: flex;justify-content: space-around;">
    <img src="https://futsalguide.com/wp-content/uploads/2019/01/futsal-logo-1.png" height="100" align="center" alt="CoolBrand">
</a>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <a href="#" class="navbar-brand">
        <img src="../assets/image/lapangan/bola.png" height="40" alt="CoolBrand">
    </a>
    <a class="navbar-brand" href="index.php">FUTSAL GUIDE</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">BERANDA
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../tentang.php">TENTANG</a>
            </li>
            <li class="nav-item" style="padding-top:3%; margin-left:10px;">
            <script src="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/theme.js"></script>
            <script>
                const themeConfig = new ThemeConfig();
                // place customizations here
                themeConfig.initTheme();

                // this will write the html to the document and return the element.
                const darkSwitch = writeDarkSwitch(themeConfig);
            </script>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li><h4 style="padding-top:10%; color:white;">&nbsp;&nbsp;Hi, <?php echo $_SESSION["name"]; ?> &nbsp;</h4></li>
            <li style="padding-top:2%;"><a href="/user" class="btn btn-primary btn-lg active bg-info" role="button" aria-pressed="true" style="margin-bottom:10px;"><i class="fas fa-user"></i>         Akun</a></li>
            <li style="padding-top:2%; margin-left:10px;"><a href="../logout.php" class="btn btn-primary btn-lg active bg-danger" role="button" aria-pressed="true" style="margin-bottom:10px;"><i class="fas fa-sign-out-alt"></i>           LOGOUT</a></li>
        </ul>
    </div>
</nav>
</body>
</html>