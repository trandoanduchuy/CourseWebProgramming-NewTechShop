<?php

/* This trait helps controllers to directly deal with databse instead through models */
trait Database 
{
    /* Method to connect to MySQL Database */
    private function connect() 
    {
        $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME; 
        $con = new PDO($string, DBUSER, DBPASS);
        return $con;
    }

    /* Method to get all rows from a table */
    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        
        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
        return false;
    }

    /* Method to get a row from a table */
    public function getRow($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        
        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result[0];
            }
        }
        return false;
    }
}

