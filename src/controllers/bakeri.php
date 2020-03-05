<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace


//include commands.php file
include __DIR__ . '/../controllers/commands.php';


//read table bakeri
$app->get('/bakeri', function (Request $request, Response $response, array $arg){
  $data = getAllbakeri($this->db);
  return $this->response->withJson(array('data' => $data), 200);
});


//request table bakeri by condition (name)
$app->get('/bakeri/[{name}]', function ($request, $response, $args){
  $foodname = $args['name'];
$data = getbakeri($this->db,$foodname);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'no data'), 404);
}
 return $this->response->withJson(array('data' => $data), 200);
});

//request table bakeri by condition (category)
$app->get('/bakeri/cate/[{category}]', function ($request, $response, $args){
  $foodcategory = $args['category'];
$data = getbakericategory($this->db,$foodcategory);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'no data'), 404);
}
 return $this->response->withJson(array('data' => $data), 200);
});

//add inside table
$app->post('/bakeri/add', function ($request, $response, $args) {
$form_data = $request->getParsedBody();
$data = createbakeri($this->db, $form_data);
if ($data <= 0) {
  return $this->response->withJson(array('error' => 'add data fail'), 500);
}
return $this->response->withJson(array('add data' => 'success'), 201);
});


//delete row or table bakeri
$app->delete('/bakeri/del/[{name}]', function ($request, $response, $args){
    
  $foodname = $args['name'];
 
$data = deletebakeri($this->db,$foodname);
if (empty($data)) {
 return $this->response->withJson(array($foodname=> 'is successfully deleted'), 202);};
});

//edit table bakeri
$app->put('/bakeri/edit/[{name}]', function ($request,  $response,  $args){
  $foodname = $args['name'];
  
 $form_dat=$request->getParsedBody();
  
$data=updatebakeri($this->db,$form_dat,$foodname);
return $this->response->withJson(array('data' => $data), 200);
});

