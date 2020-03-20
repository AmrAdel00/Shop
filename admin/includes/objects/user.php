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

            $stmt = $this -> db -> prepare("INSERT INTO user(name , password , email) VALUES(?,?,?)");
            $stmt -> bindParam(1,$this -> name);
            $stmt -> bindParam(2,$this -> password);
            $stmt -> bindParam(3,$this -> email  );
            $stmt -> execute();

        }

        public function edit($id,$username,$password,$email){

            $stmt = $this -> db -> prepare("UPDATE user SET name = ? , password = ?, email = ? WHERE ID = ?");
            $stmt -> execute(array($username,$password,$email,$id));

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

    }

