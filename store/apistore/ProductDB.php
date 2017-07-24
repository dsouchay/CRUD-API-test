<?php

class ProductDB {
    
    protected $mysqli;
    const LOCALHOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'storedb';
    

    public function __construct() {           
        try{
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch (mysqli_sql_exception $e){
            http_response_code(500);
            exit;
        }     
    } 
    
   
    public function getProduct($id=0){      
        $stmt = $this->mysqli->prepare("SELECT * FROM product WHERE id=? ; ");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $products = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $products;              
    }
    
  
    public function getProducts(){        
        $result = $this->mysqli->query('SELECT * FROM product');          
        $products = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $products; 
    }
  
    public function insertProduct($name='',$available=false,$price=0.0,$description=''){
        $stmt = $this->mysqli->prepare("INSERT INTO product(name,available,price,description,created) VALUES (?,?,?,?,?); ");
   		$date = date('Y-m-d');
		$stmt->bind_param('ssdss', $name,$available,$price,$description,$date);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
  
    public function deleteProduct($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM product WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
   
    public function updateProduct($id,$newName,$available,$price,$description) {
        if($this->checkIDPRoduct($id)){
			$date = date('Y-m-d');
            $stmt = $this->mysqli->prepare("UPDATE product SET name=?,available=?,price=?,description=?,created=? WHERE id = ?; ");
            $stmt->bind_param('ssssss', $newName,$available,$price,$description,$date,$id);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        }
        return false;
    }
    
  
    public function checkIDPRoduct($id){
		
        $stmt = $this->mysqli->prepare("SELECT * FROM product WHERE ID=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }
  
 } 