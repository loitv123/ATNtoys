<?php
// session_start();
require_once 'header.php'
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
<div class="container">
    <?php
    if (isset($_GET['id'])) :
        $pid = $_GET['id'];
        require_once 'connect.php';
        $conn = new connect();
        $db_link = $conn->connectToPDO();
        $sql = "SELECT * from tbl_product where p_id = ?";
        $stmt = $db_link->prepare($sql);
        $stmt->execute(array($pid));
        $re = $stmt->fetch(PDO::FETCH_BOTH);
    ?>
        <div class="grid-rows" style="background-color: white; padding:20px; margin:20px;">
            <div class="row">
                <div class="col-md-6" style="background-color: white;">
                    <div style="padding: 5px; margin: 5px; background-color:gray">
                        <img style="height: 460px; width: 564px; padding:2px;" src="../image/<?= $re['p_image'] ?>" class="card-img-top" alt="" style="margin: auto;" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 style="text-align: center;"><?= $re['p_name'] ?></h2>
                    <ul style="list-style-type: none;">
                        <h1 style="width: fit-content; text-align:center; padding:1cm; padding-left:0%;">
                            <txt class="px-mx-12">price:</txt><?= $re['p_price'] ?> &#8363
                        </h1>
                        <h4 style="width: fit-content; text-align:center; padding:1cm; padding-bottom:0%;padding-left:0%">Description:</h4><?= $re['p_des'] ?></li>
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
    <h2>nothing to show</h2>
<?php
    endif;
?>

<?php
include_once 'footer.php'
?>