<?php
session_start();
if (isset($_POST['btnAdd'])) {
    // echo "aa";
    $PID = $_POST['pid'];
    $uid = $_SESSION['user_id'];
    include_once "connect.php";
    $c = new Connect();
    $dblink = $c->connectToPDO();
    $sql = "INSERT INTO `tbl_cart` (`user_id`, `p_id`, `p_count`, `date`) VALUES (?,?,?,CURDATE())";
    $re = $dblink->prepare($sql);
    $stmtcart = $re->execute(array($uid, $PID, 1));
    if (isset($stmtcart)) {
        echo '<script>alert("Add to cart successfully")</script>';
        header("Location: index.php");
    }
}
?>
