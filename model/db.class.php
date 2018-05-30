<?php
/*
-prepared statements used in all functions. user inout doesn't have to be sanitized
CLASS METHODS:

1) public __construct
	-Retrieves PDO instance, saves it in class property for more convinient access.
	PDO class is singleton, so only one instance will be in memory
	
2) public dbSelect
	-running simple selects-statements. no "where-clause" constructed.
	-no use of transactions
	
3) public dbSelect_where
	-running select-statements with "where-clause"
	-no use of transactions

4) public dbUpdate
	-running update-statements
	-no use of transactions
	
5) public dbDeletes
	-running delete-statements
	-no use of transactions
	
6) public dbInsert
	-running insert statements
	-no use of transactions
*/
class db{
	protected $registry = null; /* stores registry ref */
	protected $db = null;
	
	public function __construct(){
		$this->db = pdo_db::getInstance();
		$this->registry = pdo_db::get_registry(); /* retrieve registry reference from pdo */
		/* this manner of registry retrieval is mrely for convinience, 
		as it may have been acquired via an argument in the constructor */
	}
	
	/* 	**Runs simple select queries to database, returning assoc array of rows.
		*Throws PDOException on PDO-related error, and php-Exception on argument/code error error
		-$table: name of table or join-statement to select from
		-$field_array: array of fields to select 
		-[optional]$limit: string, used to determin "limit" part of select statement */
	public function dbSelect($table, $field_array, $limit=''){
		$str_fields='';
		
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		/* generate field-list part of select statement */
		if(is_array($field_array)){
			foreach($field_array as $field){
				$str_fields.=$field.', ';
			}
			$str_fields = substr($str_fields,0,strlen($str_fields)-2);/* cuts off last comma: ', ' */
		}else if($field_array=='*'){
			$str_fields='*';
		}else{
			throw new Exception('$field_array argument must be an array or \'*\'');
		}
		
		/* check $limit arguments, set it up properly for concatination to sql-string */
		if(!empty($limit)){
			$limit = ' limit '.$limit;
		}
		
		$db_stmt=$this->db->prepare('select '.$str_fields.' from '.$table.$limit);/* generate prepare statement */
		$db_stmt->execute();/* execute prepared statement */
		return $db_stmt->fetchAll(PDO::FETCH_ASSOC); /* return rows in assoc array */
	}
	
	
	/* 	**Runs select queries to database, returning assoc array of rows.
		*Throws PDOException on PDO-related error, and php-Exception on argument/code error error
		-$table: name of table or join-statement to select from
		-$field_array: array of fields to select
		-$clause_array: array for building "where" part of sql-statement.
			-structure: $key=>$val
					-where $key is the fieldname, $val the field-value
		-$where_type: default is 'and'. determines whether 'or' or 'and' will be used to join up
						"where" part of sql-statement
		-[optional]$limit: string, used to determin "limit" part of select statement */	
	public function dbSelect_where($table, $field_array, $clause_array, $where_type='and', $limit=''){
		$str_fields='';
		$str_where='';
		
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		/* generate field-list part of select statement */
		if(is_array($field_array)){
			foreach($field_array as $field){
				$str_fields.=$field.', ';
			}
			$str_fields = substr($str_fields,0,strlen($str_fields)-2);/* cuts off last comma: ', ' */
		}else if($field_array=='*'){
			$str_fields='*';
		}else{
			throw new Exception('$field_array argument must be an array or \'*\'');
		}
		
		/* check $limit arguments, set it up properly for concatination to sql-string */
		if(!empty($limit)){
			$limit = ' limit '.$limit;
		}
		
		/* if $clause_array variable is array, generate "where" part of select statement, then bind paramaters */
		if(is_array($clause_array)){
			if(strtolower($where_type)=='or'){
				$wh_join = ' or ';
				$j_len = 4;
			}else{
				$wh_join =' and ';
				$j_len = 5;
			}
			foreach($clause_array as $key => $val){
	 			$str_where.=$key.' = :'.$key.$wh_join;
			}
			$str_where = ' where '.substr($str_where,0,strlen($str_where)-$j_len);/* cuts off last ' and ' or ' or ' */
			$db_stmt=$this->db->prepare('select '.$str_fields.' from '.$table.$str_where.$limit);
			foreach($clause_array as $key => $val){
				$db_stmt->bindValue(':'.$key, $val);/* bind paramaters */
			}
		}else{
			$db_stmt=$this->db->prepare('select '.$str_fields.' from '.$table.$limit);
		}
		
		//echo 'select '.$str_fields.' from '.$table.$str_where.$limit.'<br/><br/>';
		$db_stmt->execute();/* execute prepared statement */
		return $db_stmt->fetchAll(PDO::FETCH_ASSOC); /* return rows in assoc array */
	}
	
	/* 	**Runs update queries to database, returning number of affected rows.
		*Throws PDOException on PDO-related error, and php-Exception on argument/code error error
		-$table: name of table to update
		-$set_array: array for building "set" part of sql-statement.
			-structure: $key=>$val
					-where $key is the fieldname, $val the updated field-value
		-$clause_array: array for building "where" part of sql-statement.
			-structure: $key=>$val
					-where $key is the fieldname, $val the field-value
		-$where_type: default is 'and'. determines whether 'or' or 'and' will be used to join up
						"where" part of sql-statement
		-$limit: string, used to determin "limit" part of update statement. Single numeric value expected,
							otherwise set defaulted to 1. */
	public function dbUpdate($table, $set_array, $clause_array, $where_type='and', $limit='1'){
		$str_set='';
		$str_where='';
		
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		/* generate field-list part of select statement */
		if(is_array($set_array)){
			foreach($set_array as $key => $val){
				$str_set.=$key.' = :up_'.$key.', ';
			}
			$str_set = ' set '.substr($str_set,0,strlen($str_set)-2);/* cuts off last comma: ', ' */
		}else{
			throw new Exception('$set_array argument must be an array');
		}
		
		/* check $limit arguments, set it up properly for concatination to sql-string */
		/* for updates, limit is a single numeric value. if supplied limit is bad, default to 1 */
		if(empty($limit)){
			$limit = '';
		}else if(is_numeric($limit)){
			$limit = ' limit '.$limit;
		}else if(!empty($limit)){
			$limit = ' limit 1';
		}
		
		/* if $clause_array variable is array, generate "where" part of select statement, then bind paramaters */
		if(is_array($clause_array)){
			if(strtolower($where_type)=='or'){
				$wh_join = ' or ';
				$j_len = 4;
			}else{
				$wh_join =' and ';
				$j_len = 5;
			}
			foreach($clause_array as $key => $val){
				$str_where.=$key.' = :'.$key.$wh_join;
			}
			$str_where = ' where '.substr($str_where,0,strlen($str_where)-$j_len);/* cuts off last ' and ', or the last ' or ' */
			$db_stmt=$this->db->prepare('update '.$table.$str_set.$str_where.$limit);
			foreach($clause_array as $key => $val){
				$db_stmt->bindValue(':'.$key, $val);/* bind "where" paramaters */
			}
			foreach($set_array as $key => $val){
				$db_stmt->bindValue(':up_'.$key, $val);/* bind "set" paramaters */
			}
		}else{
			$db_stmt=$this->db->prepare('update '.$table.$str_set.$limit);
			echo 'update '.$table.$str_set.$limit;
			foreach($set_array as $key => $val){
				$db_stmt->bindValue(':up_'.$key, $val);/* bind "set" paramaters */
			}
			
		}
		$db_stmt->execute();/* execute prepared statement */
		return $db_stmt->rowCount();/* return number of affected rows */
	}
	
	/* 	**Runs insert queries to database, returning number rows inserted and last insert-ID in simple assoc array.
		*Throws PDOException on PDO-related error, and php-Exception on argument/code error error
		-$table: name of table to update
		-$value_array: array for building "values" part of sql-statement.
			-structure: $key=>$val
					-where $key is the fieldname, $val the updated field-value */
	public function dbInsert($table, $value_array){
		$str_val='';
		$str_fields='';
		
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		/* generate values-part of insert statement */
		if(is_array($value_array)){
			foreach($value_array as $key => $val){
				$str_fields.=$key.', '; /* will be used to build "field-list" part of insert statement */
				$str_val.=':'.$key.', '; /* will be used to build "values" part of insert statement */
			}
			
			/* cuts off last comma: ', ' and puts braces around statements */
			$str_fields = ' ('.substr($str_fields,0,strlen($str_fields)-2).') ';
			$str_val = ' ('.substr($str_val,0,strlen($str_val)-2).') ';
		}else{
			throw new Exception('$value_array argument must be an array');
		}
		$db_stmt=$this->db->prepare('insert into '.$table.$str_fields.' values '.$str_val);
		foreach($value_array as $key => $val){
			$db_stmt->bindValue(':'.$key, $val);/* bind paramaters */
		}
		
		/* execute prepared statement, return number of affected rows and last insert-ID in simple assoc array */
		return array('row_count' => $db_stmt->execute(), 'last_insert_id' => $this->db->lastInsertId());
	}
	
	/* 	**Runs delete queries to database, returning number of affected rows.
		*Throws PDOException on PDO-related error, and php-Exception on argument/code error error
		-$table: name of table or join-statement to select from
		-$clause_array: array for building "where" part of sql-statement.
			-structure: $key=>$val
					-where $key is the fieldname, $val the field-value 
		-[optional]$limit: string, used to determin "limit" part of update statement. Single numeric value expected,
							otherwise set defaulted to 1. */
	public function dbDelete($table, $clause_array, $limit='1'){
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		if(is_array($clause_array)){
			$str_where='';
			
			/* generate "where" part of sql-statement */
			foreach($clause_array as $key => $val){
				$str_where.=$key.' = :'.$key.' and ';
			}
			
			/* check $limit arguments, set it up properly for concatination to sql-string */
			/* for deletes, limit is a single numeric value. if supplied limit is bad, default to 1 */
			if(is_numeric($limit)){
				$limit = ' limit '.$limit;
			}else if(!empty($limit)){
				$limit = ' limit 1';
			}
			
			$str_where = ' where '.substr($str_where,0,strlen($str_where)-5);/* cuts off last ' and ' */
			$db_stmt=$this->db->prepare('delete from '.$table.$str_where.$limit);
			foreach($clause_array as $key => $val){
				$db_stmt->bindValue(':'.$key, $val);/* bind paramaters */
			}
			$db_stmt->execute();
			return $db_stmt->rowCount();/* return number of affected rows */
		}else{
			throw new Exception('$clause_array argument must be an array');
		}
	}
	
	public function dbUpdate_trans($table, $set_array, $clause_array, $where_type='and', $limit){
		$str_set='';
		$str_where='';
		
		if(empty($table)) throw new Exception('Error: Invalid table name supplied');
		
		try{
			$this->db->beginTransaction();
			
			/* generate field-list part of select statement */
			if(is_array($set_array)){
				foreach($set_array as $key => $val){
					$str_set.=$key.' = :up_'.$key.', ';
				}
				$str_set = ' set '.substr($str_set,0,strlen($str_set)-2);/* cuts off last comma: ', ' */
			}else{
				throw new Exception('$set_array argument must be an array');
			}
			
			/* check $limit arguments, set it up properly for concatination to sql-string */
			/* for updates, limit is a single numeric value. if supplied limit is bad, default to 1 */
			if(is_numeric($limit)){
				$limit = ' limit '.$limit;
			}else if(!empty($limit)){
				$limit = ' limit 1';
			}
			
			/* if $clause_array variable is array, generate "where" part of select statement, then bind paramaters */
			if(is_array($clause_array)){
				if(strtolower($where_type)=='or'){
					$wh_join = ' or ';
					$j_len = 4;
				}else{
					$wh_join =' and ';
					$j_len = 5;
				}
				foreach($clause_array as $key => $val){
					$str_where.=$key.' = :'.$key.$wh_join;
				}
				$str_where = ' where '.substr($str_where,0,strlen($str_where)-$j_len);/* cuts off last ' and ', or the last ' or ' */
				$db_stmt=$this->db->prepare('update '.$table.$str_set.$str_where.$limit);
				foreach($clause_array as $key => $val){
					$db_stmt->bindValue(':'.$key, $val);/* bind "where" paramaters */
				}
				foreach($set_array as $key => $val){
					$db_stmt->bindValue(':up_'.$key, $val);/* bind "set" paramaters */
				}
			}else{
				foreach($set_array as $key => $val){
					$db_stmt->bindValue(':up_'.$key, $val);/* bind "set" paramaters */
				}
				$db_stmt=$this->db->prepare('update '.$table.$str_set.$limit);
			}
			$db_stmt->execute();/* execute prepared statement */
			
			$this->db->commit();
			
			return $db_stmt->rowCount();/* return number of affected rows */
		}catch(PDOException $e){
			$this->db->rollback();
			throw new Exception($e->getMessage());
		}
	}
	
	public function raw_select($sql){
		$dt = $this->db->query($sql);
		return $dt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function raw_execute($sql){
		return $this->db->exec($sql);
	}
}