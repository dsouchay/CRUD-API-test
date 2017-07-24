<?php

class UserDB {
    
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
    
  
    

	

    public function UserAutentication($user,$pass){  
		$stmt = $this->mysqli->prepare("SELECT * FROM user WHERE email=?");
		$stmt->bind_param("s", $user);
		if($stmt->execute()){
			$result = $stmt->get_result();        
			if ($result->num_rows == 1){   
					$product = $result->fetch_all(MYSQLI_ASSOC); 
					$stmt->close();
				if ($product[0]["pasword"]==$pass ){
					$rol=$this->UserRol($user);
					$product[0]["id_rol"]=$rol[0]["id_rol"];
					return $product;
				}
					
			}
		}        
		return false;
	} 
	
		    


    public function UserRol($user){  
		$stmt = $this->mysqli->prepare("SELECT id_rol FROM user_rol as a inner join user as b on a.id_user = b.id where b.email=?");
		$stmt->bind_param("s", $user);
		if($stmt->execute()){
			$result = $stmt->get_result();        
			if ($result->num_rows == 1){   
				$rol = $result->fetch_all(MYSQLI_ASSOC); 
				$stmt->close();
				return $rol;
			}

		}
		
	return 0;
	
		
	} 
  
 } 