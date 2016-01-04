<?php
class Data_base extends CI_Model
{


    private $tbl;

    private $data;

    private $where;

    private $limit;

    private $order;

    private $group_by;

    private $like;

    function __construct($tbl = null , $data = null,$where = null ,$limit = null,$order = null,$group_by=null,$like = null)
    {
        parent::__construct();

        $this->tbl = $tbl;

        $this->where = $where ;

        $this->data = $data;

        $this->limit = $limit;
        $this->order = $order;
        $this->group_by = $group_by;
        $this->like = $like;

    }

    public function query($sql = null){

        $data =  $this->db->query($sql)->result_array();

        $this->db->close();

        return $data;
    }

    public function Join($table =  null ,$where = null, $type_join = null){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        foreach ($table as $index=>$row){

            $this->db->join($row,$where[$index],$type_join[$index]);

        }

        $data = $this->db->get()->result_array();

        $this->db->close();

        return $data;
    }





    public function get_is_exists(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

       $data = $this->db->get()->result_array();

        $this->db->close();

        return $data;
    }


    public function change(){

        $this->db->where($this->where);

        $this->db->update($this->tbl, $this->data);

        $data =  $this->db->affected_rows();

        $this->db->close();

        return $data;

    }

    public function delete(){

        $this->db->where($this->where);

        $this->db->delete($this->tbl);

        $data =  $this->db->affected_rows();

        $this->db->close();

        return $data;

    }

    public function add(){

        $this->db->insert($this->tbl, $this->data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        $this->db->close();

        return $insert_id;



    }
    public function get_where(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }



    public function count_where(){

        $this->db->select($this->data);

        $this->db->count_all($this->tbl);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function get_where_limit(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        $this->db->limit($this->limit);

        $data = $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function get_where_order(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        foreach($this->order as $index=>$value)
        {$this->db->order_by($index,$value);}

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function get(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public static function select_multiple_table($table =null , $column_one = null ,$column_two = null , $column_select = null,$column_select_name=null){


        return "( select ".$column_select." from  ".$table." where ".$column_one." = ".$column_two.") ".$column_select_name;

    }

    public function select_multiple_table_status($table =null , $column_one = null ,$column_two = null , $coloumn_select = null , $column_status = null , $value = 1){




        return "( select ".$coloumn_select." from  ".$table." where ".$column_one." = ".$column_two." and ".$column_status." = ".$value.")";

    }

    public function select_count_multiple_table($table =null , $column_one = null ,$column_two = null , $coloumn_select = null){


        return "( select ".$coloumn_select." from  ".$table." where ".$column_one." = ".$column_two.") ".$coloumn_select;

    }

    public function select_multiple_where_table($table =null , $where = null , $coloumn_select = null){


        return "( select ".$coloumn_select." from  ".$table." where  ".$where." )  " .$coloumn_select;

    }


    public function get_multiple_where($column_one = null ,$column_two = null ){

        return $column_one." = ".$column_two.'  ';
    }

    public function count_multiple_table($table =null,$column_one = null){

        return "(select count(".$column_one.") from ".$table.") ".$column_one;
    }

    public function get_sum($table = null , $column = null){

        if(!empty($table) && !empty($column)){

            return 'sum('.$table.'.'.$column.') as sum';
        }
        else{
            return false;
        }

    }

    public function array_sum($array = null , $col = null){

        $sum = '(';
        $num = 1 ;

        foreach($array as $row){

            $sum .= $row;

            if(count($array) != $num )
            {
                $sum .= ' + ';

            }

            $num++;
        }
        $sum .= ' ) '.$col;

        return $sum;


    }

    public function get_between($from = null ,$to = null ){

        if(!empty($from) && !empty($to)){

            return " BETWEEN ".$from." AND ".$to.")";
        }
        else{
            return false;
        }

    }

    public function get_between_other($from = null ,$to = null ){

        if(!empty($from) && !empty($to)){

            return 'BETWEEN '.$from." AND ".$to." ";
        }
        else{
            return false;
        }

    }


    public function get_date_format($table = null , $column = null){

        if(!empty($table) && !empty($column)){

            return "DATE_FORMAT(".$table.".".$column.",'%Y-%m-%d')";
        }
        else{
            return false;
        }

    }

    public function get_last_q(){
       return  $this->db->last_query();
    }

    public function get_date_format_without_seconds($table = null , $column = null){

        if(!empty($table) && !empty($column)){

            return "DATE_FORMAT(".$table.".".$column.",'%Y-%m-%d %H:%i')";
        }
        else{
            return false;
        }

    }

    public function get_limit_order_by(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        foreach($this->order as $index=>$value){

            $this->db->order_by($index,$value);

        }

        $this->db->limit($this->limit);


        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function function_random(){

        return 'RANDOM';
    }




    public function change_no_where(){

        $this->db->update($this->tbl, $this->data);

        $data =  $this->db->affected_rows();

        $this->db->close();

        return $data;


    }


    public function get_group_by_where(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);


        foreach($this->group_by as $value){

            $this->db->group_by(array($value));

        }

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function get_like_where(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);

        foreach($this->like as $index=>$value){

            $this->db->like($index, $value);

        }

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }
    public function get_order_by(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        //$this->db->where($this->where);

        foreach($this->order as $index=>$value){

            $this->db->order_by($index,$value);

        }


        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }

    public function get_group_by_order_by_where(){

        $this->db->select($this->data);

        $this->db->from($this->tbl);

        $this->db->where($this->where);


        foreach($this->group_by as $value){

            $this->db->group_by(array($value));

        }

        foreach($this->order as $index=>$value){

            $this->db->order_by($index,$value);

        }

        $data =  $this->db->get()->result_array();

        $this->db->close();

        return $data;


    }


    public function get_sum_multiple($table = null,$column_sum = null,$column_one = null,$column_two = null,$as = null){

        $data=$column_sum[0];

        for($i =1;$i < count($column_sum);$i++){

            $data.=' + '.$column_sum[$i];

        }
        return '( select sum('.$data.') as sum from '.$table.' where '.$column_one.' = '.$column_two.' )'.$as;



    }








}