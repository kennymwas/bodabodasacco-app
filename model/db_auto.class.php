<?php	
class db_auto extends db{
	
	protected $table_name='';
	protected $field_data;
	protected $condition_array;
	
	protected $pkey_name='';
	protected $pkey_value='';
	
	protected $fetch_success=false;
	protected $is_view=false;
	
	protected $last_insert_id=0;
	protected $last_affected_rows=0;
	
	protected $prim_col='';
	
	protected $handle_def_values=1;
	protected $def_value_fields=array();
		
	/* contains the dynamic properties, using the magic functions __get and __set */
	protected $vars = array();
	
	public function __construct($condition_array='', $table_name='', $field_data='*'){
		parent::__construct();
		if(!empty($condition_array) && !empty($table_name) && !empty($field_data)){
			$this->field_data = $field_data;
			$this->table_name = $table_name;
			$pos = strpos($this->table_name , " ");
			if($pos != false) $this->is_view = true;
			if(is_array($condition_array)){
				$this->condition_array = $condition_array;
			}else{
				$this->condition_array = array( $table_name.'_id' => $condition_array );
			}
			$mbr = $this->dbSelect_where($table_name, $field_data, $this->condition_array);
			if(empty($mbr)){
				throw new Exception('Record not found in database usibg supplied record identifiers. Record deleted in '.$table_name.'?');
			}else{
				foreach($mbr[0] as $key => $val){
					$this->vars[$key] = $val;
				}
				$this->fetch_success=true;
			}
		}
	}
	
	public function get_fetch_status(){
		return $this->fetch_success;
	}
	
	public function get_default_values(){
		return $this->def_value_fields;
	}
	
	public function get_last_insert_id(){
		return $this->last_insert_id;
	}
	
	public function get_affected_row_count(){
		return $this->last_affected_rows;
	}
	
	
	
	public function save($limit='1'){
		if($this->is_view){
			throw new Exception('Update/Insert cannot be executed based on complex select-statements');
		}
		$arr = array();
		$re_fetch = false;
		if($this->fetch_success==false){
			if($this->handle_def_values){
				foreach($this->vars as $key=>$val){
					if(!in_array($key, $this->def_value_fields)){
						$arr[$key] = $val;
					}else{
						$re_fetch = true;
					}
				}
			}
			//print_r($arr);
			$inst =  $this->dbInsert($this->table_name, $arr);
			$this->last_insert_id = $inst['last_insert_id'];
			$this->last_affected_rows = $inst['row_count'];
			if(!empty($this->prim_col)) $this->vars[$this->prim_col] = $this->last_insert_id;
			if($this->fetch_success == true && !empty($this->prim_col)){
				$this->db_auto(array($this->prim_col => $this->last_insert_id), $this->table_name);
			}
			return $this->last_insert_id;
		}else{
			$this->last_affected_rows=$this->dbUpdate($this->table_name, $this->vars, $this->condition_array, 'and', $limit);
			return $this->last_affected_rows;
		}	
	}
	
	public function load_structure($table_name){
		$this->table_name = $table_name;
		try{
			$mbr = $this->dbSelect_where('INFORMATION_SCHEMA.Columns', array('COLUMN_NAME', 'COLUMN_KEY', 'EXTRA', 'COLUMN_DEFAULT IS NOT NULL AS COLUMN_DEFAULT'), array('TABLE_NAME' => $table_name));
			$rec_count = count($mbr);
			foreach($mbr as $rec){
				$this->vars[$rec['COLUMN_NAME']] = '';
				if($rec['COLUMN_KEY']=='PRI' && $rec['EXTRA']=='auto_increment'){
					$this->prim_col = $rec['COLUMN_NAME'];
				}
				if($rec['COLUMN_DEFAULT']){
					$this->def_value_fields[] = $rec['COLUMN_NAME'];
				}
			}
		}catch(Exception $err){
			throw new Exception('Unable to read table structure for'.$table_name);
		}
	}
	
	/* get data item from $vars array	*/
	public function __get($key){
		if(!isset($this->vars[$key])){
			if(!isset($this->def_value_fields[$key])){
				throw new Exception('Calling undefined property '.$key.' from object at '.$this->table_name);
			}else{
				return '';
			}
		}
		return $this->vars[$key];
	}
	
	public function is_empty($key){
		return empty($this->vars[$key]);
	}
	
	public function __isset($key){
		return isset($this->vars[$key]);
	}
	
	/* set undefined variables into $vars */
	public function __set($key, $value){
		$this->vars[$key] = $value;
	}
	
	public function delete_me(){
		if(!empty($this->table_name)){
			$this->dbDelete($this->table_name, $this->condition_array);
		}else{
			throw new Exception('Table-name or condition array data not set. Delete cannot execute');
		}
	}
	
	public function delete($cond_array){
		if(!empty($this->table_name) && is_array($cond_array)){
			$this->dbDelete($this->table_name, $cond_array);
		}else{
			throw new Exception('Table-name or condition array data not set. Delete cannot execute');
		}
	}
	
	public function delete_data($table_name, $cond_array){
		if(!empty($table_name) && is_array($cond_array)){
			$this->dbDelete($table_name, $cond_array);
		}else{
			throw new Exception('Table-name or condition array data not set. Delete cannot execute');
		}
	}
	
	public function get_table_rows_in_array($limit='' ,$table_name='', $field_data='*', $cond_arr=''){
		if($cond_arr=='1'){
			if(empty($this->condition_array)){
				throw new Exception('Table data is un-initialized. Cannot apply condition array to retrieve row data');
			}else{
				$cond_arr = $this->condition_array;
			}
		}
		if(!empty($table_name) && !empty($field_data)){
			return $this->dbSelect_where($table_name, $field_data, $cond_arr, $limit);
		}else if(empty($table_name) && !empty($field_data) && !empty($this->table_name)){
			return $this->dbSelect_where($this->table_name, $field_data, $cond_arr, $limit);
		}else if(!empty($table_name) && empty($field_data) && !empty($this->field_data)){
			return $this->dbSelect_where($table_name, $this->field_data, $cond_arr, $limit);
		}else if(empty($table_name) && empty($field_data) && !empty($this->table_name) && !empty($this->field_data)){
			return $this->dbSelect_where($this->table_name, $this->field_data, $cond_arr, $limit);
		}else{
			throw new Exception('Cannot retrieve row data from database. Data not supplied or incorrectly initialized');
		}
	}
	
	public function get_table_row_count($table_name='', $cond_arr=''){
		
		if($cond_arr=='1'){
			if(empty($this->condition_array)){
				throw new Exception('Table data is un-initialized. Cannot apply condition array to retrieve row-count data');
			}else{
				$cond_arr = $this->condition_array;
			}
		}
		
		$limit = '';
		
		if(!empty($table_name)){
			$row_count = $this->dbSelect_where($table_name, array('count(*)'), $cond_arr, $limit);
		}else if(!empty($this->table_name)){
			$row_count = $this->dbSelect_where($this->table_name, array('count(*)'), $cond_arr, $limit);
		}else{
			throw new Exception('Cannot retrieve row-count data from database. Data not supplied or incorrectly initialized');
		}
		
		return $row_count[0]['count(*)'];
	}
	
	public function get_data_in_array(){
		return $this->vars;
	}
	
	public function set_data_in_array($arr){
		$this->vars = $arr;
	}
	
}