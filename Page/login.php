<?php
include_once "connect.php";
session_start();
if (isset($_POST['btnLogin'])) {
    if (isset($_POST['password']) && isset($_POST['email'])) {
        $pwd = $_POST['password'];
        $email = $_POST['email'];
        $c = new Connect();
        $dblink = $c->connectToPDO();
        $sql = "SELECT * FROM staff WHERE Email = ? AND password = ?";
        $stmt = $dblink->prepare($sql);
        $re = $stmt->execute(array($email, $pwd));
        $numrow = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_BOTH);

        if ($numrow == 1) {
            echo "Login successfully!";
            $_SESSION['user_name'] = $row['Name'];
            $_SESSION['user_email'] = $row['Email'];
            $_SESSION['user_id'] = $row['ID'];
            header("Location: index.php");
            exit;
        } else {
            echo "Something wrong with your info!";
        }
    } else {
        echo "Please enter your info!";
    }
}
?>
<?php
include'header2.php';
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/footer.css">
     <link rel="stylesheet" href="header2.css">
     <link rel="stylesheet" href="search.css">
<style>
    body{
        background-image: linear-gradient(to  bottom right, blue, red, green);
    }
    footer{
        position: absolute ;
        bottom: 0;
        width: 100%;
        left: 0;
    }
    header{
        position: absolute;
        top: 0;
        width: 100%;
        right: 0;
    }
.login-form {
    top: 30px   ;
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    border-radius: 25px;
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
    margin-top: 100px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
.search{
        background-color: none;
    }
</style>
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Login</h2>       
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Login</button>
        </div>
        <!-- <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>         -->
        <p class="text-center"><a href="regis.php">Create an Account</a></p>
    </form>
    
</div>

</body>
<?php
    include'footer.php'
?>