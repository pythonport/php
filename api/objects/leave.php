<?php


class Leave
{
// database connection and table name
    private $conn;
    private $table_name = "leaverecord";

    // object properties
    public $tid;
    public $leaveDate;
    public $leaveDay;
    public $leaveType;
    public $createdOn;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`TID`, `LEAVEDATE`, `LEAVEDAY`, `LEAVETYPE`, `CREATEDON`)
                  VALUES
                        ('".$this->tid."', '".$this->leaveDate."', '".$this->leaveDay."', '".$this->leaveType."', '".$this->createdOn."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                tid='".$this->tid."'
            AND 
                leavedate='".$this->leaveDate."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}