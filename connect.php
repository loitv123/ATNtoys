<?php
    class Connect{ 
        public $server;
        public $user;
        public $password;
        public $dbName;
        public function __construct()
        {
            $this->server = "grp6m5lz95d9exiz.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
            $this->user = "nqvfmr7oy30t11aw";
            $this->password ="qjx0h9qon1v1ctxw";
            $this->dbName = "q2cqbb0q01mauptc";
        }
        //Option 1: my sql
        function connectToMySql(): mysqli{
            $conn_my = new mysqli($this->server,$this->user,$this->password,$this->dbName);
            if($conn_my->connect_error){
                die("Failed".$conn_my->connect_error);
                } else{
                    // echo "Connect from mysqli";
                }
                return $conn_my;
        }
        
        //option 2: PDO
        function connectTOPDO():PDO{
            try{
                $conn_pdo = new PDO("mysql:host=$this->server;dbname=$this->dbName",$this->user,$this->password);
                }catch(PDOException $e){
                    die("Failed $e");
                }
                return $conn_pdo;
             }
    }
    // $c = new Connect();
    // $c = new Connect();
    // $c->connectToMySql();
    //  $c->connectTOPDO();
   
?>