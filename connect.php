<?php
    class Connect{ 
        public $server;
        public $user;
        public $password;
        public $dbName;
        public function __construct()
        {
            $this->server = "co28d739i4m2sb7j.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
            $this->user = "dzbfwgkv753m2h6m";
            $this->password ="n0b58tf0iuybybu1";
            $this->dbName = "p85lrj5nnptmbqim";
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