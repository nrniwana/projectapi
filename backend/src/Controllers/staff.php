<?php 

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include adminProc.php file 
include __DIR__ .'/function/staffProc.php';


//alow cors
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
//end

// FOR staff

//read table staff 
$app->get('/staff', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table staff 
$app->get('/allstaff',function (Request $request, Response $response,  array $arg) { 

    $data = getAllstaff($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table order by condition (staff id) 
$app->get('/staff/[{id}]', function ($request, $response, $args){   
    $staffId = $args['id']; 
    if (!is_numeric($staffId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getstaff($this->db, $staffId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method order
$app->post('/staff/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createstaff($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


//delete row Order
$app->delete('/staff/del/[{id}]', function ($request, $response, $args){   
    $staffId = $args['id']; 
    
   if (!is_numeric($staffId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deletestaff($this->db,$staffId); 
       if (empty($data)) { 

           return $this->response->withJson(array($staffId=> 'is successfully deleted'), 202);}; }); 
 

   
//put table order 
$app->put('/staff/put/[{id}]', function ($request, $response, $args){
    $staffId = $args['id']; 
    
    if (!is_numeric($staffId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updatestaff($this->db,$form_dat,$staffId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});
   