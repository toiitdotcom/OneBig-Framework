<?php

/**
 * Query đến nhiều database thì nhập thêm tên database trước table ví dụ: radius.radcheck
 * public $nameData = array('radius', 'radius2');
 */
// $data = $this->db()->query('SELECT * FROM radius.radcheck')->result_object();
// $data2 = $this->db()->query('SELECT * FROM goldengate.campaign')->result_object();
// $data3 = $this->db()->query('SELECT * FROM radius.radcheck')->result_object();

// echo "<pre>";
// print_r($data);
// print_r($data2);
// print_r($data3);
// die();


Class Database {

    //public $dbServer = 'localhost';
    //public $username = 'root';
    //public $passwword = '';
    public $dbServer = '127.0.0.1';
    public $username = 'root';
    public $passwword = '';
    public $nameData = array('dbname');
    public $data;
    public $result_object = array();
    public $result_array = array();
    public $_query;

    public function __construct() {
        //parent::__construct();
    }

    public function connectDb() {
        $this->data['connectdb'] = mysqli_connect($this->dbServer, $this->username, $this->passwword) or die(mysql_error());

        /**
         * Thiết lập chọn 1 hoặc nhiều db cho nhiều việc dkm
         */
        if (!in_array($this->nameData, array(null, '', '0'))) {
            foreach ($this->nameData as $el => $le) {
                mysqli_select_db($this->data['connectdb'], $le) or die(mysql_error());
            }
        }
        mysqli_set_charset($this->data['connectdb'], 'utf8') or die(mysql_error());
    }

    private function _insert($sql) {
        $this->connectDb();
        if (mysqli_query($this->data['connectdb'], $sql) === TRUE) {
            return $this->data['connectdb']->insert_id;
        } else {
            return 0;
        }
    }

    private function _update($sql) {
        $this->connectDb();
        mysqli_query($this->data['connectdb'], $sql);
        return $this->data['connectdb']->affected_rows;
    }

    public function query($sql) {
        $this->connectDb();
        $this->_query = mysqli_query($this->data['connectdb'], $sql) or die(mysql_error());
        return $this;
    }

    public function result_object() {
        $arr = array();
        while ($row = mysqli_fetch_object($this->_query)) {
            $arr[] = $row;
        }

        mysqli_free_result($this->_query);
        mysqli_close($this->data['connectdb']);
        return (object) $arr;
    }

    public function row_object() {
        $arr = mysqli_fetch_object($this->_query);
        mysqli_free_result($this->_query);
        mysqli_close($this->data['connectdb']);
        return (object) $arr;
    }

    public function result_array() {
        $arr = array();
        while ($row = mysqli_fetch_assoc($this->_query)) {
            $arr[] = $row;
        }

        mysqli_free_result($this->_query);
        mysqli_close($this->data['connectdb']);
        return $arr;
    }

    public function num_rows() {
        $ds = mysqli_num_rows($this->_query);
        mysqli_free_result($this->_query);
        mysqli_close($this->data['connectdb']);
        return $ds;
    }

    /**
     * @param type $table
     * @param type $array
     * @return type that bai thi tra ra 0, con thanh cong thi tra ra id ma thang nay no insert vào
     */
    public function insert($table, $array) {
        $keys = array();
        $values = array();
        foreach ($array as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }
        return $this->_insert('INSERT INTO ' . $table . ' (`' . implode('`, `', $keys) . '`) VALUES ("' . implode('", "', $values) . '")');
    }

    public function update($table, $values, $where) {
        $valstr = array();
        foreach ($values as $key => $val) {
            $valstr[] = '`'.$key . '` = "' . $val .'"';
        }
        return $this->_update('UPDATE ' . $table . ' SET ' . implode(', ', $valstr)
                . ' WHERE ' . $where);
    }


}
