<?php
    class Connect{ 
        public $server;
        public $user;
        public $password;
        public $dbName;
        public function __construct()
        {
            $this->server = "pfw0ltdr46khxib3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
            $this->user = "gumkxwyo5amj7pgg";
            $this->password ="g3c908xmbrgr7h9d";
            $this->dbName = "wmn6c77tfp895h9v";
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