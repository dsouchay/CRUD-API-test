<?php
class UserAPI {    
    public function API(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods:OPTIONS,GET,PUT,POST,DELETE,PATCH');
		header('Access-Control-Allow-Headers:Content-Type');


        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
     
        case 'POST':
             $this->checkAutorization();
            break;                
      
        default: //metodo NO soportado
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
		

	 function getUserRol(){

	    if($_GET['action']=='rol'){   
          $obj = json_decode( file_get_contents('php://input') );   
          $objArr = (array)$obj;
          if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($obj->user)){
             $product = new UserDB();    
             $rol=$product->UserRol( $obj->user );
             
			 if($rol) {$this->response(200,"success","record founded"); }                            
         }else{
             $this->response(422,"error","The property is not defined");
         }
     } else{               
         $this->response(400);
     }  
}	 

  function checkAutorization(){
      if($_GET['action']=='user'){   
          $obj = json_decode( file_get_contents('php://input') ); 		  
          $objArr = (array)$obj;
		  if (empty($objArr)){
             $this->response(422,"error","Nothing to add. Check json");                           
         }else if(isset($obj->user)){
             $product = new UserDB();    
             $response=$product->UserAutentication( $obj->user, $obj->password );
			 echo json_encode($response,JSON_PRETTY_PRINT);

             
			 if($response) {$this->response(); }                            
         }else{
             $this->response(422,"error","The property is not defined");
         }
     } else{               
         $this->response(400);
     }  
 }

		
}


$userAPI = new UserAPI();
$userAPI ->API();
?>