 <?php
include_once'connect.php';
session_start();
?>
  <link rel="stylesheet" href="header2.css">
  <link rel="stylesheet" href="search.css">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Loi Gear </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
  <link rel="icon" href="../img/bmw-icon-png-24.jpg">
</head>
<style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

  .dropdown:hover .dropdown-menu {
    display: block;
  }
</style>
<style>
  .nav-link {
    font-size: 20px;
    width: auto;
    color: white;
  }

</style>
<style>
  nav {
    margin: auto;
    padding: auto;
    color: black;
    background-color: #25274D;

    position: relative;
  }
</style>
<style>
  .card-title {
    color: #49C5B6;
    
  }
</style>

<style>
  .navbar-brand {
    font-family: Brush Script MT;
    font-size: 40px;
    color: aqua;
  }
</style>
<style>
  .btn-primary {
    color: #212529;
    background-color: #7cc;
    border-color: #5bc2c2
  }
</style>
<nav class="navbar navbar-expand-md" style="background: rgba(17, 10, 98, 1);border-bottom: solid 1px black;">
  <div class="container-fluid">
    <a href="index.php" class="navbar-brand">
      <h1>ATN</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <div class="navbar-nav">
        
        <a href="#allpro" class="nav-link">PRODUCT</a>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">CATEGORY</a>
          <div class="dropdown-menu">
          <?php
                        $query = "SELECT * FROM category";
                        $conn = new Connect();
                        $dblink = $conn->connectToMySQL();
                        $re = $dblink->query($query);
                       
                        while($row=$re->fetch_assoc()):
                        ?>
                        <a class="dropdown-item" href="dropdown.php?pCatID=<?=$row['ID']?>"> <?=$row['Cat_name']?> </a>
                        <?php
                        endwhile;
                        ?>
          </div>
        </div>
        <a href="cart.php" class="nav-link"><b>My cart</b></a>
      </div>
      <div class="search">
    <form class="searchbox" action="search.php">
      <input type="text" class="form-control" placeholder="Search for product..." name="search">
      <button class="search_button" name="btnSearch"><i class="bi bi-search"></i></button>
    </form>
  </div>
  <div class="navbar-nav ms-auto iconuser">
    <?php
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $c = new Connect();
        $dblink = $c->connectToPDO();
        $sql = "SELECT Name FROM staff WHERE Email = ?";
        $stmt = $dblink->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $row['Name'];
        ?>
        <a href="promana.php" class="nav-link">   ~ Managment ~   </a>
        <p href="#" style="color: black; font-weight:bold; " class="nav-item nav-link">Welcome <?= $name ?></p>
        <a href="logout.php" class="nav-item nav-link">Logout</a>
    <?php
    } else {
        ?>
        <a href="login.php"><i class="fa-solid fa-right-to-bracket">Login</i></a>
    <?php
    }
    ?>
</div>
    </div>
  </div>
</nav>