<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-image: linear-gradient(to  bottom right, blue, red, green);
        background-repeat: no-repeat;
        
    }
.container{
    border: 9px solid black;
    margin: 120px 250px;
    padding:50px;
    width: 60%;
    height: 200px;
    text-align: center;
}
.container h1{
        text-align: center;
        
}
.container ul{
    display: flex;
}
.container ul li{
    text-decoration: none;
    padding: 0 20px;
    font-size: 20px;
    text-align: center;
}

</style>
<body>      

            <div class="container">
            <h1>Admin</h1>
             <ul class="list">
                
                <li><a href="#">Login</a></li>

             </ul>
             <a href="logout.php" class="nav-item nav-link" >Logout</a>
            </div>
</body>
</html>