<?php
include_once "header5.php";
// if ($_SESSION() <> 'admin') {
//     header("Location: logout.php");
// }


if (isset($_POST['addstaff'])) {
    $c = new Connect();
    $dblink = $c->connectToPDO();

    $name = $_POST['s_name'];
    $phone = $_POST['s_phone'];
    $email = $_POST['s_email'];
    $password = $_POST['s_password'];

    $sql = "INSERT INTO `staff`(`Name`, `phone`, `Email`, `password`) VALUES (?, ?, ?, ?)";
    $stmt = $dblink->prepare($sql);
    $stmt->execute(array($name, $phone, $email, $password));
}
?>

<div class="container col-sm-10 text-bg-dark m-3 mx-auto shadow" style="border-radius: 30px; padding:10px 30px; background-color:rgba(66, 206, 255, 0.8)!important;">
    <h2 class="col-3 m-3 mb-4 mx-auto text-center">Add Staff</h2>

    <form action="" id="StaffForm" name="StaffForm" method="POST" class="needs-validation">
        <div class="row pb-3">
            <label for="StaffName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="s_name" id="StaffName" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <label for="StaffPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" name="s_phone" id="StaffPhone" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <label for="StaffEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="s_email" id="StaffEmail" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <label for="StaffPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="s_password" id="StaffPassword" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <div class="d-grid col-2 mt-3 mx-auto">
                <input type="submit" value="Add Staff" class="btn btn-primary" name="addstaff" id="addstaff" href="">
            </div>
        </div>
    </form>
</div>