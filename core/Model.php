<?php
trait Model
{ 
    use Database;
    protected $limit            = 10;
    protected $offset           = 0;
    protected $order_type       = "desc";
    protected $order_column     = "id";
    public $errors           = [];

    /* Method to return all the rows  that satisfy conditions */
    public function findAll() {
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        
        return $this->query($query);
    }

    /* Method to return only the first row that satisfy conditions */
    public function first($data, $data_not=[]) {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key. " = :" . $key ." && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        
        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if($result)
            return $result[0];
        return false;
    }

    /* Method to insert a row to a table */
    public function insert($data, $allowedColumns = []) {
        /** Remove unwanted data **/
        if(!empty($allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
        $this->query($query, $data);
        return false;
    }   

    /* Method to update a row from a table */
    public function update($id, $data, $id_column = 'id', $allowedColumns = []) {
        /** Remove unwanted data **/
        if(!empty($this->$allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!!in_array($key, $this->$allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key. " = :" . $key .", ";
        }

        $query = trim($query, ", ");
        
        $query .= " where $id_column = :$id_column";
        $data[$id_column] = $id;
        
        $this->query($query, $data);
        return false;
    }

    /* Method to delete a row from a table based on id */
    public function delete($id, $id_column = 'id') {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);
        return false;
    }

    /* Method to return all the rows  that satisfy conditions */
    public function where($data, $data_not = []) {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key. " = :" . $key ." && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        
        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }
}