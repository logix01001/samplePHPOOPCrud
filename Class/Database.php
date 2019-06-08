<?php

class Database
{
	
	private $pdo;
	
	private $pdoWhere;
	private $pdoTable;
	private $pdoUpdate;
	private $pdoBindFields = [];

	/*-------------------------------------------------------------------------------------------*/	
	public function __construct() {
		$this->DBConnection();
	}
	
	/*-------------------------------------------------------------------------------------------*/	
	private function DBConnection() {
		$this->pdo = new PDO( 'mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db').';charset=utf8;', 
		Config::get('mysql/username') , Config::get('mysql/password') );
		
		$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
	}
	
	/*
	 * 		INSERT
	 ************************/
	public function insert(array $values){
			
				$fields = "`" . implode("`,`",array_keys($values)) . "`";
				$bindFields = ":" . implode(",:",array_keys($values));
				
				try {
					$stmt = $this->pdo->prepare(
						'Insert into `'.$this->pdoTable.'`(' . $fields . ')VALUES('.$bindFields.')'
					);
					
					foreach($values as $key=>$value){
						
						if($key == 'Password'){
							$stmt->bindValue(':'.$key,md5($value),PDO::PARAM_STR);
						}
						else if(!is_string($value)){
							
							$stmt->bindValue(':'.$key,$value,PDO::PARAM_INT);
								
						}else{
							
							$stmt->bindValue(':'.$key,$value,PDO::PARAM_STR);
						}
					}
					
					$stmt->execute();
					 
					echo 'Insert Successfully';
					
				} catch( PDOException $e ) {
					
					echo  $e->getMessage();
				}
				
		
		
	}
	
	/*
	 * 		SET TABLE
	 ************************/
	public function table($table){
		
		$this->pdoTable = $table;
		
		return $this;
	}
	
	
	
	
	
	/*
	 * 		UPDATE
	 ************************/
	public function update(array $arrayUpdate){
		
	
				$set = [];
				
				foreach($arrayUpdate as $key => $value){
					$set[] = '`' . $key . '` = :'.$key;
				}
				
				$set = implode(',',$set);
				
				//return 'UPDATE ' . $this->pdoTable . ' SET ' . $set . ' '. $this->pdoWhere;
				try {
					$stmt = $this->pdo->prepare(
						'UPDATE ' . $this->pdoTable . ' SET ' . $set . ' '. $this->pdoWhere
					);
					
					foreach($arrayUpdate as $key=>$value){
						
						if(!is_string($value)){
							
							$stmt->bindValue(':'.$key,$value,PDO::PARAM_INT);
							
							
						}else{
							
							$stmt->bindValue(':'.$key,$value,PDO::PARAM_STR);
						}
						
					}
					
					$stmt->execute();
					 
					echo 'UPDATE Successfully';
					
				} catch( PDOException $e ) {
					
					echo  $e->getMessage();
				}
		
		
	}
	
	
	/*
	 * 		WHERE
	 ************************/
	
	public function where($field,$operator,$values = null){
		
		
		
		if($values == null){
			
			$values = $operator;
			$operator = "=";
			
		}
		
		if(is_string($values)){
			$values = "'" . $values . "'";
		}
		
		
		if($this->pdoWhere == null ){
			$this->pdoWhere = ' WHERE `' . $field . '` ' . $operator . ' ' . $values;
		}else{
			$this->pdoWhere .=  ' AND `' . $field . '` ' . $operator . ' ' . $values;
		}
		
		return $this;
		
		
	}
	
	/*
	 * 		WHERE Employee ID
	 ************************/
	 
	 public function findEID($EID){
		 
				try {
					$stmt = $this->pdo->prepare(
						'SELECT * FROM customer where CustomerID = :EID'
					);
					
					$stmt->bindValue(':EID',$EID,PDO::PARAM_INT);
					$stmt->execute();
					
					$row = $stmt->fetchAll( PDO::FETCH_ASSOC );
					
					return $row;
				} catch( PDOException $e ) {
					
					echo  $e->getMessage();
				} 
		 
	 }
	 
	 /*
	 * 		WHERE Employee ID
	 ************************/
	 
	 public function findEIDDelete($EID){
		 
				try {
					$stmt = $this->pdo->prepare(
						'DELETE FROM customer where CustomerID = :EID'
					);
					
					$stmt->bindValue(':EID',$EID,PDO::PARAM_INT);
					$stmt->execute();

					
				} catch( PDOException $e ) {
					
					echo  $e->getMessage();
				} 
		 
	 }
	
	/*
	 * 		GET
	 ************************/
	
	public function get(){
		

				try {
					$stmt = $this->pdo->prepare(
						'SELECT * FROM `'. $this->pdoTable . '` ' . $this->pdoWhere
					);
					$stmt->execute();
					
					$row = $stmt->fetchAll( PDO::FETCH_ASSOC );
					
					return $row;
				} catch( PDOException $e ) {
					
					echo  $e->getMessage();
				} 
				
				
	
	}
	

	
	

	/*-----------------------------------------------------------------------------------------*/	
	public function __destruct() {
		$this->pdo = null;
	}

	
}
