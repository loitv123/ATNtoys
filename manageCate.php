<?php
include_once 'header5.php';
include_once 'connect.php';
?>

<body>
    <div id="main" class="container">
        <div class="page-heading pb-2 mt-4 mb-2">
            <h1>Product Category</h1>
        </div>
        <form name="frm" method="post" action="">
            <p>
                <a href="addCategory.php" class="text-decoration-none">Add</a>
            </p>
            <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>Category ID</strong></th>
                        <th><strong>Category Name</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new Connect();
                    $db_link = $conn->connectToPDO();
                    $sql = "SELECT * from category";
                    $stmt = $db_link->prepare($sql);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) :
                    ?>
                        <?php
                        if (isset($_POST['btndel'])) {
                            $value = $_POST['ID'];
                            $sqlSelect = "DELETE FROM category WHERE ID = ?";
                            $stmt = $db_link->prepare($sqlSelect);
                            $execute = $stmt->execute([$value]);
                            if ($execute == false) {
                                echo "Failed " . $execute;
                            }
                        }
                        ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Cat_name'] ?></td>
                            <td style='text-align:center'><a href="addCategory.php?cid=<?= $row['ID'] ?>" class="text-decoration-none">Edit</a></td>
                            <td style='text-align:center'>
                                <form action="#" method="post">
                                    <input type="hidden" name="ID" value="<?= $row['ID'] ?>">
                                    <button type="submit" name="btndel" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    <!--main-->
</body>