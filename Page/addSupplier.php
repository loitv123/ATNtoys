<?php
include_once "header5.php";
ob_flush();

$conn = new Connect();
$db_link = $conn->connectToPDO();

// Check if ID parameter is set for updating action
if (isset($_GET['ID'])) {
    $supplierID = $_GET['ID'];
    $sqlSelect = "SELECT * FROM suplier WHERE ID = ?";
    $stmt = $db_link->prepare($sqlSelect);
    $stmt->execute(array($supplierID));

    if ($stmt->rowCount() > 0) {
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
        $supplierName = $supplier['Name'];
        $email = $supplier['email'];
        $phone = $supplier['phone'];
        $address = $supplier['address'];
    }
}

// Handle form submission
if (isset($_POST['txtName'])) {
    $name = $_POST['txtName'];
    $email = $_POST['txtEmail'];
    $phone = $_POST['txtPhone'];
    $address = $_POST['txtAddress'];

    if (isset($_POST['btnAdd'])) {
        $supplierID = $_POST['txtID'];
        $sqlInsert = "INSERT INTO suplier (ID, Name, email, phone, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db_link->prepare($sqlInsert);
        $execute = $stmt->execute(array($supplierID, $name, $email, $phone, $address));

        if ($execute) {
            header("Location: supmana.php");
            ob_clean();
        } else {
            echo "Failed to add supplier";
        }
    } else {
        $supplierID = $_GET['sid'];
        $sqlUpdate = "UPDATE suplier SET ID = ?, Name = ?, email = ?, phone = ?, address = ? WHERE ID = ?";
        $stmt = $db_link->prepare($sqlUpdate);
        $execute = $stmt->execute(array($supplierID, $name, $email, $phone, $address, $supplierID));

        if ($execute) {
            header("Location: manageSupplier.php");
            ob_clean();
        } else {
            echo "Failed to update supplier";
        }
    }
}
?>

<div id="main" class="container">     
    <div class="page-heading pb-2 mt-4 mb-2">
        <h1>Supplier Management</h1>
    </div>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group pb-3">
            <label for="txtID" class="col-sm-2 control-label">Supplier ID(*):</label>
            <div class="col-sm-10">
                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Supplier ID" value="<?php echo isset($_GET['sid']) ? $_GET['sid'] : ''; ?>">
            </div>
        </div>	
        <div class="form-group pb-3">
            <label for="txtName" class="col-sm-2 control-label">Supplier Name(*):</label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Supplier Name" value="<?php echo isset($supplierName) ? $supplierName : ''; ?>">
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtEmail" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtPhone" class="col-sm-2 control-label">Phone:</label>
            <div class="col-sm-10">
                <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtAddress" class="col-sm-2 control-label">Address:</label>
            <div class="col-sm-10">
                <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Address" value="<?php echo isset($address) ? $address : ''; ?>">
            </div>
        </div>
        <div class="form-group pb-3">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="<?php echo isset($_GET['sid']) ? 'btnEdit' : 'btnAdd'; ?>" id="btnAction" value="<?php echo isset($_GET['sid']) ? 'Edit' : 'Add new'; ?>" />
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Back to list" onclick="window.location.href='supmana.php'" />
            </div>
        </div>
    </form>
</div> <!-- main -->
</body>
</html>