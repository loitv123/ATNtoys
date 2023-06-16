<?php
ob_start();
include_once 'Header3.php';
?>
<?php
//if(isset($_SESSION['user'])){
// $user = $_SESSION['user'];

// if(isset($_COOKIE['cc_username'])){
//     $user = $_COOKIE['cc_username'];
$total=0;
$c = new connect();
$dblink = $c->connectToPDO();
if (isset($_SESSION['user_id'])) {
    $user = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];

    if (isset($_GET['pid'])) {
        $p_id = $_GET['pid'];
        $quantity = $_GET['quantity']; 
        // $sqlSelect1 = "SELECT p_id FROM tbl_cart WHERE user_id =? AND pid=?";
        // $re = $dblink->prepare($sqlSelect1);
        // $re->execute(array("$user_id", "$p_id"));

        $query = "UPDATE tbl_cart SET p_count = $quantity where user_id=$user_id and p_id=$p_id";
        $stmt = $dblink->prepare($query);
        $stmt->execute();
    } 
    if (isset($_GET['del_id'])) {
        $cart_del = $_GET['del_id'];
        $query = "DELETE FROM tbl_cart WHERE cart_id=?";
        $stmt = $dblink->prepare($query);
        $stmt->execute(array($cart_del));
    }
    $sqlSelect = "SELECT * FROM tbl_cart c, tbl_product p where c.p_id=p.p_id and user_id =?";
    $stmt1 = $dblink->prepare($sqlSelect);
    $stmt1->execute(array($user_id));
    $rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
} else {
    header("location:login.php");
    ob_get_flush();
}
?>

<div class="container">
    <h1 class="fw-bold mb-0 text-black py-3 ps-0">Cart</h1>
    <h6 class="mb-0 text-muted"><?= $stmt1->rowCount() ?> item(s)</h6>
    <table class="table">
        <tr>
            <th>Productname</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($rows as $row) {
        ?>
            <tr>
                <form action="" method="get">
                <td><?= $row['p_name'] ?></td>
                <td><input type="hidden" name="pid" value="<?= $row['p_id'] ?>"></td>
                <td><input id="from1" min="0" name="quantity" value="<?= $row['p_count'] ?>" type="number" class="form-control form-control-sm"/></td>
                <td>
                    <h6 class="mb-0"><span>&#8363</span> <?= $row['p_count'] ?> * <?= $row['p_price'] ?> </h6>
                </td>
                <td><a href="cart.php?del_id=<?=$row['cart_id'] ?>" class="text-muted text-decoration-non">x</a></td>
                <td><button type="submit" class="btn btn-primary">Change</button></td>
                </form>
            </tr>           
        <?php
        $total += $row['p_count'] * $row['p_price'];
        }
        ?>
    </table>
    <hr class="pt-5">
    <h5 class="fw mb-0 text-black">Total: <?=$total?></h5>
    <h5 class="fw-bold mb-0 p-5 ps-0 "><a href="index.php" class="text-body border border-dark p-1 bg-primary"><i class="bi bi-house-door"></i>back to shop</a></h5>
</div>