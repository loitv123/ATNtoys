<link rel="stylesheet" href="../css/search.css">

<link rel="stylesheet" href="../css/header2.css">

<?php
include 'header3.php';
include 'banner.php';
?>

<div class="row mx-auto">
    <?php
    if (isset($_GET['search'])) :
        include_once 'Connect.php';
        $c = new Connect();
        $dblink = $c->connectToPDO();
        $nameP = $_GET['search'];
        $sql = "SELECT * FROM products where Name_product LIKE ?";
        $re = $dblink->prepare($sql);
        $re->execute(array("%$nameP%"));
        $rows = $re->fetchAll(PDO::FETCH_BOTH);
        foreach ($rows as $row) :
    ?>
    
    <div class="col-md-4 pb-3">
        <div class="card" style="border-radius: 15px;">
            <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                <img src="../image/<?= $row['pImage'] ?>" class="card-img-top" alt="Product1" style="margin: auto; height:480px;width: 480px;" />
                <a href="detail2.php?id=<?= $row['ID'] ?>">
                    <div class="mask"></div>
                </a>
            </div>
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <p><a href="detail2.php?id=<?= $row['ID'] ?>" class="text-dark"><?= $row['Name_product'] ?></a></p>
                        <p class="small text-muted"></p>
                    </div>
                    <div>
                        <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-danger">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="small text-muted">Rated 4.0/5</p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between">
                    <p><a href="detail2.php?id=<?= $row['Name_product'] ?>" class="text-dark"><?= $row['price'] ?> $</a></p>
                    <p class="text-dark">
                        <?php
                        $catId = $row['pCatID'];
                        $conn = new Connect();
                        $dblink = $conn->connectToPDO();
                        $query = "SELECT Cat_name FROM category WHERE ID = ?";
                        $stmt = $dblink->prepare($query);
                        $stmt->execute(array($catId));
                        $result = $stmt->fetch();
                        if ($result) {
                            echo $result['Cat_name'];
                        }
                        ?>
                    </p>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                    <a href="detail2.php?id=<?= $row['ID'] ?>" class="btn btn-primary">Detail</a>
                    <form action="addtoCart.php" method="POST">
                        <input type="hidden" name="pid" value="<?= $row['ID'] ?>">
                        <button type="submit" name="btnAdd" class="btn btn-primary">Buy now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        endforeach;
    endif;
    ?>
</div>

<?php
include 'footer.php';
?>