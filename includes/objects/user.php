<?php

    class user {

        private $name;
        private $password;
        private $email;


        protected $db;

        public  function __construct($con){

            $this -> db = $con;
        }

        public function create($username,$password,$email){

            $this -> name       = filter_var($username,FILTER_SANITIZE_STRING);
            $this -> password   = password_hash($password,PASSWORD_DEFAULT);
            $this -> email      = filter_var($email,FILTER_SANITIZE_EMAIL);

            $stmt = $this -> db -> prepare("INSERT INTO user(name, password, email, Date) VALUES(?,?,?,?,now())");
            $stmt -> bindParam(1,$this -> name);
            $stmt -> bindParam(2,$this -> password);
            $stmt -> bindParam(3,$this -> email  );
            $stmt -> execute();

        }

        public function edit($id,$username,$password,$email){

            $this -> name       = filter_var($username,FILTER_SANITIZE_STRING);
            $this -> password   = password_hash($password,PASSWORD_DEFAULT);
            $this -> email      = filter_var($email,FILTER_SANITIZE_EMAIL);


            $stmt = $this -> db -> prepare("UPDATE user SET name = ? , password = ?, email = ?, avater = ?  WHERE ID = ?");
            $stmt -> execute(array($this -> name, $this -> password,$this -> email, $this -> avater,$id));

        }

        public function delete($id){

            $stmt = $this -> db -> prepare("DELETE FROM user WHERE ID = ?");
            $stmt -> execute(array($id));

        }

        public function view($id){

            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE ID = ?");
            $stmt -> execute(array($id));
            $row = $stmt -> fetch();

            return $row;
        }

        public function viewAll(){

            $stmt = $this -> db -> prepare("SELECT * FROM user");
            $stmt -> execute();
            $row = $stmt -> fetchAll();

            return $row;
        }

        public function countUser(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function countAdmin(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE GroupID = 1");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function countActive(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE status = 1 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function countPending(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE status = 0 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function viewActive(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE status = 1");
            $stmt -> execute();
            return $stmt ->fetchAll();
        }

        public function viewPending(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE status = 0");
            $stmt -> execute();
            return $stmt ->fetchAll();
        }

        public  function check($id){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE ID = ?");
            $stmt -> execute(array($id));
            $check = $stmt -> rowCount();
            return $check;
        }


    }

