<?php
include 'header3.php';
?>
<body>
  <?php
  ?>

  <banner>
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-mdb-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./image/banner.jpg " class="d-block w-100" alt="Wild Landscape"/>
    </div>
  </div>
</div>
  </banner>
  <h2 id="allpro">
    <center> ALL PRODUCT </center>
  </h2>
  <div class="row mx-auto">
    <?php
    include_once 'connect.php';
    $c = new connect();
    $dblink = $c->connectToMySQL();
    $sql = "SELECT *FROM products";
    $re = $dblink->query($sql);
    if ($re->num_rows > 0) :
      while ($row = $re->fetch_assoc()) :
    ?>
<div class="col-md-4 pb-3">
  <div class="card" style="border-radius: 15px;">
    <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
      <img src="./image/<?= $row['pImage'] ?>" class="card-img-top" alt="Product1" style="margin: auto; height:480px;width: 480px;" />
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
      <button type="submit" name="btndetail" href="detail2.php?id<?= $row['ID'] ?>" class="btn btn-primary">Detail</button>
        <form action="addtoCart.php" method="POST">
          <input type="hidden" name="pid" value="<?= $row['ID'] ?>">
          <button type="submit" name="btnAdd" class="btn btn-primary">Buy now</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <?php
      endwhile;
    else :
      echo "Not found";
    endif;
    ?>
  </div>
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">ATN company</h5>

        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
          molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae
          aliquam voluptatem veniam, est atque cumque eum delectus sint!
        </p>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">Thing we sell</h5>

        <p>
          we use to sell alot of product linke phone and computer. Sometime we have a big sale of you can access from here <a href="https://www.facebook.com/permalink.php?story_fbid=pfbid0mCfV5bXk1Xai6Ce9KwdoMaC1vG9yXN5E5RG6vKmPkZJZVCVxzbry7yXd6wTuTh8Hl&id=100021421425572">Sales of in White Sunday</a>
        </p>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->
  <!-- <footer class="footer-distributed">

    <div class="footer-right">

      <a href="https://www.facebook.com/profile.php?id=100021421425572"><i class="fa-brands fa-square-facebook"></i></a>
      <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fa-brands fa-youtube"></i></a>
      <a href="https://twitter.com/realdonaldtrump"><i class="fa-brands fa-twitter"></i></a>
      <a href="https://www.instagram.com/johncena/"><i class="fa-brands fa-instagram"></i></a>

    </div>

    <div class="footer-left">

      <p class="footer-links">
        <a href="./index.php">Introduction</a>
        <a href="#">Product</a>
        <a href="#">Projects</a>
        <a href="" target="_blank">Contact</a>
      </p>

      <p>Loi Gear &copy; 2022</p>
    </div>

  </footer> -->
  <?php
  include_once "footer.php";
  ?>
</body>

</html>