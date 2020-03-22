<?php


class department{

    private $name;
    private $description;

    protected $db;

    public function __construct($con){

        $this -> db = $con;

    }

    public function create($name,$desc){

        $stmt = $this -> db  -> prepare("INSERT INTO department(name , description) VALUES (? , ?)");
        $stmt -> bindParam(1,$name);
        $stmt -> bindParam(2,$desc);
        $stmt -> execute();

    }

    public function edit($id,$name,$desc){

        $stmt = $this -> db -> prepare("UPDATE department SET name = ? , description = ? WHERE ID = ?");
        $stmt -> execute(array($name,$desc,$id));

    }

    public function delete($id){

        $stmt = $this -> db -> prepare("DELETE FROM department WHERE ID = ?");
        $stmt -> execute(array($id));

    }

    public function view($id){

        $stmt = $this -> db -> prepare("SELECT * FROM department WHERE ID = ?");
        $stmt -> execute(array($id));
        $row = $stmt -> fetch();

        return $row;
    }

    public function viewAll(){

        $stmt = $this -> db -> prepare("SELECT * FROM department");
        $stmt -> execute();
        $row = $stmt -> fetchAll();

        return $row;
    }

    public function count(){
        $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM department");
        $stmt -> execute();
        return $stmt ->fetchColumn();
    }

}