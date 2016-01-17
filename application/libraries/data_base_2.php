<?php
class data_base_2{

    private $table ;

    private $select ;

    private $where ;

    public function __construct($table=null ,$select= null , $where = null){

        $this->table = $table;

        $this->select = $select;

        $this->where= $where;

    }

    public function sum(){

        return $this->select+ $this->where + $this->table;
    }
}