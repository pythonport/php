<?php
class TimeTable{
    // database connection and table name
    private $conn;
    private $table_name = "ttteacher";

    // object properties
    public $tid;
    public $tname;
    public $designation;
    public $day;
    public $pone;
    public $ptwo;
    public $pthree;
    public $pfour;
    public $pfive;
    public $psix;
    public $pseven;
    public $peight;
    public $pnine;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all teachers
    function read(){

        // select Teacher Time table for all day
        $query = "SELECT
                    `TID`, `TNAME`, `DESIGNATION`,`DAYNUM`,`DAY`, `PONE`, `PTWO`, `PTHREE`, `PFOUR`, `PFIVE`, `PSIX`, `PSEVEN`, `PEIGHT`, `PNINE`
                FROM
                    " . $this->table_name . " 
                WHERE
                    `tid` = '" . $this->tid . "'
                ORDER BY
                    DAYNUM";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    //function to getTeacherTimeTableOnLeave

    function getTeacherTimeTableOnLeave($leaveDate, $leaveDay) {
        // select Teacher Time table for all day
        $query = "SELECT
                    `TID`, `TNAME`, `DESIGNATION`,`DAYNUM`,`DAY`, `PONE`, `PTWO`, `PTHREE`, `PFOUR`, `PFIVE`, `PSIX`, `PSEVEN`, `PEIGHT`, `PNINE`
                FROM
                    " . $this->table_name . " 
                WHERE
                    `tid` IN (SELECT leaverecord.TID FROM leaverecord
                WHERE  leaverecord.LEAVEDATE='".$leaveDate."'
                AND leaverecord.LEAVEDAY='".$leaveDay."') 
                AND ttteacher.daynum='".$leaveDay."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}