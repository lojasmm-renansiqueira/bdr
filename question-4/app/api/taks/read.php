<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/task.php';
 
$database = new Database();
$db = $database->getConnection();
 
$task = new Task($db);
 
$stmt = $task->read();
$numRows = $stmt->rowCount();
 
if($numRows > 0){
 
    $products_arr=array();
    $products_arr["tasks"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $product_item = array(
            "idtask" => $idtask,
            "title" => $title,
            "description" => html_entity_decode($description),
            "priority" => $priority
        );
 
        array_push($products_arr["tasks"], $product_item);
    }
 
    echo json_encode($products_arr);
}else{
    echo json_encode(
        array("message" => "Nenhuma tarefa encontrada.")
    );
}
