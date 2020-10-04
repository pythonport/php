<?php
class Teacher{
    // database connection and table name
    private $conn;
    private $table_name = "teachers";

    // object properties
    public $tid;
    public $tname;
    public $design;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all teachers
    function read(){

        // select all query
        $query = "SELECT
                    `tid`, `tname`, `designation`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    SLNO";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


}