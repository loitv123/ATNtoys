<?php
include_once 'header5.php';
include_once 'connect.php';
?>

<body>
    <div id="main" class="container">
        <div class="page-heading pb-2 mt-4 mb-2 ">
            <h1>Staff</h1>
        </div>
        <form name="frm" method="post" action="">
            <p>
                <a href="addstaff.php" class="text-decoration-none">Add</a>
            </p>
            <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>Staff ID</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Phone</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'connect.php';
                    $conn = new Connect();
                    $db_link = $conn->connectToPDO();
                    $sql = "SELECT * FROM staff";
                    $re = $db_link->query($sql);
                    while ($row = $re->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <?php
                        $conn = new Connect();
                        $db_link = $conn->connectToPDO();
                        if (isset($_POST['btndel'])) :
                            $value = $_POST['s_id'];
                            $sqlSelect = "DELETE FROM staff WHERE ID = ?";
                            $stmt = $db_link->prepare($sqlSelect);
                            $execute = $stmt->execute(array("$value"));
                            if ($execute == false) {
                                echo "Failed " . $execute;
                            }
                        endif;
                        ?>
                        <tr>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td style='text-align:center'>
                                <form action="#" method="post">
                                    <input type="hidden" name="s_id" value="<?= $row['ID'] ?>">
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