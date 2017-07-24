<?php

class StoreAPI {    
    public function API(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers:Content-Type');
		
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET':
            $this->getProducts();
            break;     
        case 'POST':
             $this->saveProduct();
            break;                
        case 'PUT':
            $this->updateProduct();
            break;      
        case 'DELETE':
            $this->deleteProduct();
            break;
        default: 
            echo 'METODO NO SOPORTADO';
            break;
        }
    }
	

	 function response($code=200, $status="", $message="") {
		http_response_code($code);
		if( !empty($status) && !empty($message) ){
			$response = array("status" => $status ,"message"=>$message);  
			echo json_encode($response,JSON_PRETTY_PRINT);    
		}            
	 } 
		

	 function getProducts(){
	     if($_GET['action']=='products'){   
	 
	         $db = new ProductDB();
	         if(isset($_GET['id'])){                 
	             $response = $db->getProduct($_GET['id']);                
	             echo json_encode($response,JSON_PRETTY_PRINT);
	        }else{                    
	             $response = $db->getProducts();              
	             echo json_encode($response,JSON_PRETTY_PRINT);
	         }
	     }else{
	            $this->response(400);
	     }       
	 }	 

  function saveProduct(){
      if($_GET['action']=='products'){   
          $obj = json_decode( file_get_contents('php://input') );   
          $objArr = (array)$obj;
          if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($obj->name)){
             $product = new ProductDB();    
             $product->insertProduct( $obj->name, $obj->available, $obj->price, $obj->description );
             $this->response(200,"success","new record added");                             
         }else{
             $this->response(422,"error","The property is not defined");
         }
     } else{               
         $this->response(400);
     }  
 }


	function updateProduct() {
		if( isset($_GET['action']) && isset($_GET['id']) ){
			if($_GET['action']=='products'){
				$obj = json_decode( file_get_contents('php://input') );   
				$objArr = (array)$obj;
				if (empty($objArr)){                        
					$this->response(422,"error","Nothing to add. Check json");                        
				}else if(isset($obj->name)){
					
					$db = new ProductDB();
					$db->updateProduct($_GET['id'],$obj->name, $obj->available, $obj->price, $obj->description);
					$this->response(200,"success","Record updated");                             
				}else{
					$this->response(422,"error","The property is not defined");                        
				}     
				exit;
		   }
		}
		$this->response(400);
	} 

	function deleteProduct() {
		 
		if($_GET['action']=='products'){         
	         $db = new ProductDB();
	         if(isset($_GET['id'])){                 
	             $response = $db->deleteProduct($_GET['id']);                
	             echo json_encode($response,JSON_PRETTY_PRINT);
	        }else{                 
	                          
	            $this->response(422,"error","The property is not defined");  
	         }
	     }else{
	            $this->response(400);
	     }      
	} 	
		
}


$storeAPI = new StoreAPI();
$storeAPI->API();

?>