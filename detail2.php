<?php
// session_start();
require_once 'header3.php'
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/search.css">
<style>
    body {
        background-color: lightblue;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        left: 0;
    }

    footer .footer-right {
        margin-top: 0;

    }
</style>
<body>
<div class="container p-4">
    <?php
    if (isset($_GET['id'])) :
        $pid = $_GET['id'];
        require_once 'connect.php';
        $conn = new connect();
        $db_link = $conn->connectToPDO();
        $sql = "SELECT * from products where ID = ?";
        $stmt = $db_link->prepare($sql);
        $stmt->execute(array($pid));
        $re = $stmt->fetch(PDO::FETCH_BOTH);
    ?>
        <div class="grid-rows" style="background-color: white; padding:20px; margin:20px;">
            <div class="row">
                <div class="col-md-6" style="background-color: white;">
                    <div style="padding: 5px; margin: 5px; background-color:gray">
                        <img style="height: 460px; width: 564px; padding:2px;" src="image/<?= $re['pImage'] ?>" class="card-img-top" alt="" style="margin: auto;" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 style="text-align: center;"><?= $re['Name_product'] ?></h2>
                    <ul style="list-style-type: none;">
                        <h1 style="width: fit-content; text-align:center; padding:1cm; padding-left:0%;">
                            <txt class="px-mx-12">price:</txt><?= $re['price'] ?> $
                        </h1>
                        <h4 style="width: fit-content; text-align:center; padding:1cm; padding-bottom:0%;padding-left:0%">Description:</h4><?= $re['PDes'] ?></li>
                    </ul>

                    <form action="addtoCart.php" method="POST" style="text-justify: center; padding:1cm; padding-left:32px;">
                        <!-- <input type="hidden" name="pid" value=""> -->
                        <input type="hidden" class="form-control" name="pid" value="<?= $pid ?>">
                        <input type="submit" class="btn btn-primary shop-button" name="btnAdd" value="Add to cart" />
                    </form>
                </div>
            </div>
        </div>
</div>
<?php
    else :
?>
    <h2>Nothing to show</h2>
<?php
    endif;
?>

</body>

