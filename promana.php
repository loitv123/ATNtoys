<?php
include_once 'header5.php';
include_once 'connect.php';
?>

<body>
    <div id="main" class="container">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h1>Product </h1>
        </div>
        <form name="frm" method="post" action="">
        <p>
                <a href="addproduct.php" class="text-decoration-none">Add</a>
            </p>
            <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>Product ID</strong></th>
                        <th><strong>Product Name</strong></th>
                        <th><strong>Product Price</strong></th>
                        <th><strong>Product Old Price</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'connect.php';
                    $conn = new Connect();
                    $db_link = $conn->connectTOMYSQL();
                    $sql = "SELECT * FROM products";
                    $re = $db_link->query($sql);
                    while ($row = $re->fetch_assoc()) :
                        $productPrice = $row['price'];
                        $oldPrice = $productPrice * 0.8;
                    ?>
                        <?php
                        $conn = new Connect();
                        $db_link = $conn->ConnectToPDO();
                        if (isset($_POST['btndel'])) :
                            $value = $_POST['p_id'];
                            $sqlSelect = "DELETE FROM products WHERE ID = ?";
                            $stmt = $db_link->prepare($sqlSelect);
                            $execute = $stmt->execute(array("$value"));
                            if ($execute == false) {
                                echo "Failed " . $execute;
                            }
                        endif;
                        ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name_product'] ?></td>
                            <td><?= $productPrice ?></td>
                            <td><?= $oldPrice ?></td>
                            <td style='text-align:center'>
                                <form action="#" method="post">
                                    <input type="hidden" name="p_id" value="<?= $row['ID'] ?>">
                                    <button type="submit" name="btndel" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</body>