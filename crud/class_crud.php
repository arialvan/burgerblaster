<?php
/* Class Database PDO */
class dataBase extends PDO {
	private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
       
    private $result;    
     
    public function __construct()
        {
        $this->engine   = 'mysql';
        $this->host     = 'localhost';
        $this->database = 'mannco_blester_shop';
        $this->user     = 'root';
        $this->pass     = '';
        /*$this->user     = 'mannco_blester';
        $this->pass     = 'Blester))&';*/
               
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
	
}

/* Class Crud PDO */
class crud extends dataBase {   
        /*
    * Insert values into the table
    */
        public function insert($table,$rows)
        {
                $command = 'INSERT INTO '.$table;
                $row = null; $value=null;
                foreach ($rows as $key => $nilainya)
                {
                  $row  .=",".$key;
                  $value        .=", :".$key;
                }
               
                $command .="(".substr($row,1).")";
                $command .="VALUES(".substr($value,1).")";
                 
           
                $stmt =  parent::prepare($command);
                $stmt->execute($rows);
                $rowcount = $stmt->rowCount();
                return $rowcount;
        }
       
        /*
    * Delete records from the database.
    */
        public function delete($tabel,$where=null)
        {
                $command = 'DELETE FROM '.$tabel;
               
                $list = Array(); $parameter = null;
                foreach ($where as $key => $value)
                {
                  $list[] = "$key = :$key";
                  $parameter .= ', ":'.$key.'":"'.$value.'"';
                }
                $command .= ' WHERE '.implode(' AND ',$list);
           
                $json = "{".substr($parameter,1)."}";
                $param = json_decode($json,true);
                               
                $query = parent::prepare($command);
                $query->execute($param);
                $rowcount = $query->rowCount();
        return $rowcount;
        }
       
        /*
    * Uddate Record
    */
        public function update($tabel, $fild = null ,$where = null)
        {
                 $update = 'UPDATE '.$tabel.' SET ';
                 $set=null; $value=null;
                 foreach($fild as $key => $values)
                 {
                         $set .= ', '.$key. ' = :'.$key;
                         $value .= ', ":'.$key.'":"'.$values.'"';
                 }
                 $update .= substr(trim($set),1);
                 $json = '{'.substr($value,1).'}';
                 $param = json_decode($json,true);
                 
                 if($where != null)
                 {
                    $update .= ' WHERE '.$where;
                 }
                 
                 $query = parent::prepare($update);
                 $query->execute($param);
                 $rowcount = $query->rowCount();
         return $rowcount;
    }
       
       
        /*
    * Selects information from the database.
    */
        public function select($table, $rows, $join= null, $where = null, $order = null, $group= null, $limit= null)
        {
        $command = 'SELECT '.$rows.' FROM '.$table;
        
         if($join != null)
            $command .= ' JOIN '.$table. ' ON '.$table .'.'.$rows.'='.$table .'.'.$rows.' '.$join;
        if($where != null)
            $command .= ' WHERE '.$where;
        if($order != null)
            $command .= ' ORDER BY '.$order;  
        if($group != null)
            $command .= ' GROUP BY '.$group; 
        if($limit != null)
            $command .= ' LIMIT '.$limit;
                $query = parent::prepare($command);
                $query->execute();
                //$row =  $query->rowCount();
                $posts = array();
		if($count = $query->rowCount()>0)	{
                    $query-> setFetchMode(PDO::FETCH_ASSOC);
                    while($row = $query->fetch())
                    {
                             $posts[] = $row;
                    }
                }else{
                    echo"No Result";
                }
               //return $this->result = json_encode(array('post'=>$posts));
				 /*if($rowcount = $query->rowCount() > 0){
					     $rowcount=true;
				 }else{
					     $rowcount=false;
				 }*/
				return $this->result =$posts;
				//return $rowcount;
			   
        }
        /*
    * Returns the result set
    */
	
        public function getResult()
        {
        return $this->result;
    }
          
}

 
?>