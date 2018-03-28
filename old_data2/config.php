<?php
session_start();
$env='test';
$encriptKey='sairam786';
$rootpath='';
class Connection
{
	var $conn;
    var $type;
    function __construct()
    {   
        $this->conn = new mysqli('localhost', 'root','shiva_aws','kisanagrimall');
		$charset=$this->conn->set_charset("utf8");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function __destruct() {
      $this->connectionClose();
   }


    public function get_single_record()
    {
        
        $from=$this->from;
        $select = $this->select; 
        $where = $this->where; 
        $type = $this->type;
        $join = $this->join;
        $qurry_etra = $this->qurry_etra;

        $count_all      = 0;
        $return         = array();

        if(is_array($where)){
	        $where_q='';	
		    foreach($where as $key => $value){
		        $where_q.=''.$key.' = ';
		        $where_q.="'".$value."' and ";
		    }
		    $where=rtrim($where_q,"and ");
        }

        $qry = 'select ' . $select . ' from ' . $from .$join. ' where ' . $where.' '.$qurry_etra;
        $result1        = $this->conn->query($qry);
        $rowcount  = $result1->num_rows;
        $result['qry'] = $qry;
        //$result['rowcount'] = $rowcount;
        if($rowcount>0){
            $result1        = $result1->fetch_assoc();
            foreach($result1 as $key => $value){
                $result[$key]=utf8_encode($value);
            }
            return $result;
        } else
        {
            return $result;
        }
    }

    public function get_all_records()
    {
        $from=$this->from;
        $select = $this->select; 
        $where = $this->where; 
        $limit = $this->limit; 
        $offset = $this->offset; 
        $type = $this->type;
        $qurry_etra = $this->qurry_etra; 
        $join = $this->join; 
        $innertype = $this->innertype;
        
        $count_all = 0;
        $return    = array();
        if($where=='')
            $where=1;
        else if(is_array($where)){
            $where_q='';    
            foreach($where as $key => $value){
                $where_q.=' '.$key.' = ';
                $where_q.="'".$value."' and";
            }
            $where=rtrim($where_q,"and");
        }

        if (intval($where) == 1 || $where == '' || $where == '1')
            $raw_qry = $qry = 'select ' . $select . ' from ' . $from . ' ' .$join.' '. $qurry_etra;
        else
            $raw_qry = $qry = 'select ' . $select . ' from ' . $from .' '.$join. ' where ' . $where . ' ' . $qurry_etra;

        if ($limit != '')
            $qry = $qry . ' LIMIT ' . $limit;
        if ($offset != '')
            $qry = $qry . ' OFFSET ' . $offset;

        if (strcmp($qry, $raw_qry)) {
            $cout_all_qry = 'select COUNT(*) as cnt from ' . $from .' '.$join. ' where ' . $where;
            $result_all = $this->conn->query($cout_all_qry);
		    $count_all=$result_all->fetch_assoc()['cnt'];	
        }

        $result = $this->conn->query($qry);
        $count  = $result->num_rows;
        if ($count > 0)
            for($res = array(); $tmp = $result->fetch_assoc();) {  $tmp["type"] = $innertype; $res[]       = $tmp; }
		else
            $res = array();

        $return['qry']        = $qry;
	    $return['type']       = $type;
        $return['startIndex'] = $offset == '' ? 1 : intval($offset);
        $return['count']      = $limit == '' ? $count : intval($limit);
        $return['totalCount'] = $count_all == 0 ? intval($count) : intval($count_all);
        $return['items']      = $res;
     //   $result               = $this->conn->query("INSERT INTO `log` (`remarks`) VALUES ('')");
        return $return;
    }	



    public function fetchAll($from, $select = ' * ', $where = '1', $limit = '', $offset = '',$qurry_etra = '')
    {
        
        $count_all = 0;
        $return    = array();
        if(is_array($where)){
            $where_q='';    
            foreach($where as $key => $value){
                $where_q.=' `'.$key.'` = ';
                $where_q.="'".$value."' and";
            }
            $where=rtrim($where_q,"and");
        }

        if (intval($where) == 1 || $where == '' || $where == '1')
            $raw_qry = $qry = 'select ' . $select . ' from ' . $from . ' ' . $qurry_etra;
        else
            $raw_qry = $qry = 'select ' . $select . ' from ' . $from . ' where ' . $where . ' ' . $qurry_etra;
        if ($limit != '')
            $qry = $qry . ' LIMIT ' . $limit;
        if ($offset != '')
            $qry = $qry . ' OFFSET ' . $offset;

        if (strcmp($qry, $raw_qry)) {
             $cout_all_qry = 'select COUNT(*) as cnt from ' . $from . ' where ' . $where;
            $result_all = $this->conn->query($cout_all_qry);
            $count_all=$result_all->fetch_assoc()['cnt'];   
        }

        $result = $this->conn->query($qry);
        $count  = $result->num_rows;
        if ($count > 0)
            $res=$result->fetch_all();
        else
            $res = array();

        $return['type']       = $type;
//        $return['qry']        = $qry;
        $return['startIndex'] = $offset == '' ? 1 : intval($offset);
        $return['count']      = $limit == '' ? $count : intval($limit);
        $return['totalCount'] = $count_all == 0 ? intval($count) : intval($count_all);
        $return['items']      = $res;
        if($this->type==''||$this->type=='json')
            return json_encode($return);
        else    
        return $return;
    }   

    public function e_get($qry, $limit = '', $offset = '')
    {
        
        $raw_qry   = $qry;
        $count_all = 0;
        $return    = array();
        if ($limit != '')
            $qry = $qry . ' LIMIT ' . $limit;
        if ($offset != '')
            $qry = $qry . ' OFFSET ' . $offset;
        if (strcmp($qry, $raw_qry)) {
            $result_all = $this->conn->query($raw_qry);
            $count_all  = $result_all->num_rows;
        }
        $result = $this->conn->query($qry);
        $count  = $result->num_rows;
        if ($count > 0)
            for ($res = array(); $tmp = $result->fetch_assoc(); $res[] = $tmp);
        else
            $res = array();
        $return['no_of_rows_returnd'] = $count;
        $return['total_no_of_rows']   = $count_all == 0 ? $count : $count_all;
        $return['items']              = $res;
        return $return;
    }

    public function insertquery($values='',$into='')
    {

        
	    $return = array();
		$indexes = $inseart_values = array();
        foreach($values as $key => $value){
		 $indexes[]=$key;
		 $inseart_values[]=str_replace("'","\'",$value);
		}
	    $buildquery= "INSERT INTO  ".$into." (`".implode("`, `",$indexes)."`) values ('".implode("', '",$inseart_values)."')";

		 $return['qry']=$buildquery;

         if($result = $this->conn->query($buildquery)){
			$return['status'] = $result;
            $return['lid'] = $this->conn->insert_id;
			$return['remarks']="successfully insertted";
		 } else {
				$return['status']=$result;
				$return['remarks']="Error Occurred";
		 }
		return $return;
    }

        public function insertData()
    {        
        $return = array();
        $indexes = $inseart_values = array();
        foreach($this->data as $key => $value){
         $indexes[]=$key;
         $inseart_values[]=str_replace("'","\'",$value);
        }
        $buildquery= "INSERT INTO  ".$this->table." (`".implode("`, `",$indexes)."`) values ('".implode("', '",$inseart_values)."')";
        //$return['qry']=$buildquery;
         if($result = $this->conn->query($buildquery))
            $this->insert_id = $this->conn->insert_id;       
        return $result;
    }

    public function failed_user_login($uid)
    {         
            $qry ='UPDATE cn_users SET `PASSWORD_TRY_FAILED` = `PASSWORD_TRY_FAILED`+1 where `ID` = '.$uid;
            return $result         = $this->conn->query($qry);
    }

    public function update_table()
    {        
        $set_q='';
        foreach($this->updateDataset as $key => $value){
            $set_q.='`'.$key.'` = ';
            $set_q.="'".str_replace("'","\'",$value)."',";
        }
        $where_q='';
        foreach($this->where as $key => $value){
            $where_q.='`'.$key.'` = ';
            $where_q.="'".$value."' and ";
        }
        $set_q= substr($set_q,0,-1);
        $where_q=substr($where_q,0,-4);
        $qry = ' UPDATE  ' . $this->table . ' SET '.$set_q.' where ' . $where_q.' ';
        return $this->conn->query($qry);
    }


    public function delete_table()
    {
        
        $where_q='';
        foreach($this->where as $key => $value){
            $where_q.='`'.$key.'` = ';
            $where_q.="'".$value."' and ";
        }
        $where_q=substr($where_q,0,-4);
        $qry = 'DELETE  FROM ' . $this->table . ' where ' . $where_q.'';
        $result['status']         = $this->conn->query($qry);
     //   $result['qry']         = $qry;
        return $result;
    }

    public function connectionClose()
    {
        $this->conn->close();
    }

}

function dataEncode($str,$key=''){
    global $encriptKey;
    if($key=='')
    $key=$encriptKey;
    $encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encoded;
}

function dataDecode($str,$key=''){
    $str=str_replace(' ','+',$str);
    global $encriptKey;
    if($key=='')
    $key=$encriptKey;
    return  rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
}

function printData($data,$exit=0){
    global $env;
    if($env!='live'){
        if(is_array($data))
            echo "<pre>";
            print_r($data);
        if(is_array($data))
            echo "</pre>";
        if($exit) exit;
    }
}

function printDate($date,$patrn="d-m-Y"){
    return date($patrn,strtotime($date));
}

function pageNav($url){
    global $webUrl;
    header('Location: '.$webUrl.$url);
}



?>
