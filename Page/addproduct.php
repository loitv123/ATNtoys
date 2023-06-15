<?php
include_once "header5.php";
// if ($_SESSION() <> 'admin') {
//     header("Location: logout.php");
// }


if (isset($_POST['upproduct'])) {
    $c = new Connect();
    $dblink = $c->connectToPDO();

    $pname = $_POST['p_name'];
    $pcatID = $_POST['p_cat'];
    $supID = $_POST['sup_id'];
    $pimage = str_replace(' ', '-', $_FILES['p_image']['name']);
    $price = $_POST['p_price'];
    $pdes = $_POST['p_des'];
    $pquantity = $_POST['p_quantity'];

    $storedPath = "../image/";
    $flag = move_uploaded_file($_FILES['p_image']['tmp_name'], $storedPath . $pimage);
    if ($flag) {
        $sql = "INSERT INTO `products`(`Name_product`, `pCatID`, `Sup_ID`, `pImage`, `Price`, `PDes`, `PQuantity`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dblink->prepare($sql);
        $stmt->execute(array($pname, $pcatID, $supID, $pimage, $price, $pdes, $pquantity));
    }
}
?>
<div class="container col-sm-10 text-bg-dark m-3 mx-auto shadow" style="border-radius: 30px; padding:10px 30px; background-color:rgba(66, 206, 255, 0.8)!important;">
    <h2 class="col-3 m-3 mb-4 mx-auto text-center">Add Product</h2>

    <form action="" id="ProductForm" name="ProductForm" method="POST" class="needs-validation" enctype="multipart/form-data">
        <div class="row pb-3">
            <label for="ProductName" class="col-sm-2 col-form-label">Product Name</label>
            <div class="col-sm-10">
                <input type="text" name="p_name" id="ProductName" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <label for="ProductPrice" class="col-sm-2 col-form-label">Product Price</label>
            <div class="col-sm-10">
                <input type="number" name="p_price" id="ProductPrice" class="form-control" required>
            </div>
        </div>

        <div class="row pb-3">
            <label for="ProductDescription" class="col-sm-2 col-form-label">Product Description</label>
            <div class="col-sm-10">
                <input type="text" name="p_des" id="ProductDescription" class="form-control">
            </div>
        </div>

        <div class="row pb-3">
            <label for="ProductStatus" class="col-sm-2 col-form-label">Product Status</label>
            <div class="col-sm-10">
                <input type="text" name="p_status" id="ProductStatus" class="form-control">
            </div>
        </div>

        <div class="row pb-3">
            <label for="ProductQuantity" class="col-sm-2 col-form-label">Product Quantity</label>
            <div class="col-sm-10">
                <input type="text" name="p_quantity" id="ProductQuantity" class="form-control">
            </div>
        </div>

        <div class="row pb-3">
            <div class="form-group">
                <label for="Pro_image" class="col-sm-2 col-form-label">Image</label>
                <input type="file" name="p_image" id="Pro_image" class="form-control" value="">
            </div>
        </div>

        <select class="form-select" aria-label="Default select example" name="p_cat">
            <option selected>Select Category</option>
            <?php
                $query = "SELECT * FROM category";
                $conn = new Connect();
                $dblink = $c->connectToMySQL();
                $re = $dblink->query($query);

                while ($row = $re->fetch_assoc()) :
            ?>
            <option value="<?=$row['ID']?>"><?=$row['Cat_name']?></option>
            <?php 
            endwhile;
            ?>
        </select>

        <select class="form-select" aria-label="Default select example" name="sup_id">
            <option selected>Select Supplier</option>
            <?php
                $query = "SELECT * FROM suplier";
                $conn = new Connect();
                $dblink = $c->connectToMySQL();
                $re = $dblink->query($query);

                while ($row = $re->fetch_assoc()) :
            ?>
            <option value="<?=$row['ID']?>"><?=$row['Name']?></option>
            <?php 
            endwhile;
            ?>
        </select>

        <div class="row pb-3">
            <div class="d-grid col-2 mt-3 mx-auto">
                <input type="submit" value="Add Product" class="btn btn-primary" name="upproduct" id="upproduct" href="">
            </div>
        </div>
    </form>
</div>