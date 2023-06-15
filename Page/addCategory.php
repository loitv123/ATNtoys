<?php
include_once "header5.php";
ob_flush();


$conn = new Connect();
$db_link = $conn->connectToPDO();
if (isset($_GET['ID'])) : //update action
        $value = $_GET['ID'];
        $sqlselect = "SELECT * from category where ID = ?";
        $stmt = $db_link->prepare($sqlselect);
        $stmt->execute(array("$value"));
        if ($stmt->rowCount()>0) :
                $re = $stmt->fetch(PDO::FETCH_BOTH);
                $catname = $re['Cat_name'];
        endif;
endif;
if (isset($_POST['txtName'])) :
        $cname = $_POST['txtName'];
        if (isset($_POST['btnAdd'])) :
                $cid = $_POST['txtID'];
                $sqlInsert = "INSERT INTO `category`(`ID`,`Cat_name`) VALUES (?,?)";
                $stmt = $db_link->prepare($sqlInsert);
                $execute = $stmt->execute(array("$cid","$cname"));
                if ($execute) {
                        header("Location: manageCate.php");
                        ob_clean();
                } else {
                       
                }
        else : 
                $cid = $_GET['cid'];
                $sqlUpdate = "UPDATE `category` SET `ID`=?, `Cat_name`=? WHERE `ID`=?";
                $stmt = $db_link->prepare($sqlUpdate);
                $execute = $stmt->execute(array("$cid", "$cname", "$cid"));
                if ($execute) {
                        ?>
                        <script>document.location.href="manageCate.php"</script>
                        <?php
                } else {
                        echo "Failed" . $execute;
                }
        endif;
endif;

?>


<div id="main" class="container">     
        <div className="page-heading pb-2 mt-4 mb-2 ">
        <h1>Product Category</h1>
        </div>
        <?php
          
        ?>
        <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
            <div class="form-group pb-3">
                    <label for="txtTen" class="col-sm-2 control-label">Category ID(*):  </label>
                    <div class="col-sm-10">
                            <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Categogy ID" 
                                value='<?php echo isset($_GET["cid"]) ?($_GET["cid"] ):""; ?>'>
                    </div>
            </div>	
            <div class="form-group pb-3">
                <label for="txtTen" class="col-sm-2 control-label">Category Name(*):  </label>
                    <div class="col-sm-10">
                            <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Categogy Name" 
                                value="<?php echo (isset($catname))?($catname):'';?>">
                    </div>
            </div>
            
                    
            <div class="form-group pb-3">
                <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit"  class="btn btn-primary" 
                                name="<?php echo(isset($_GET["cid"]))?"btnEdit":"btnAdd";?>" id="btnAction" 
                                value='<?php echo(isset($_GET["cid"]))?"Edit":"Add new"; ?>'/>
                        <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Back to list" onclick="window.location.href='manageCate.php'" />
                        
                </div>
            </div>
        </form>
    </div> <!--main-->
</body>



