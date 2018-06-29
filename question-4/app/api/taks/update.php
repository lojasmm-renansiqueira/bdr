<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/task.php';
 
$database = new Database();
$db = $database->getConnection();
 
$task = new Task($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$task->idtask = $data->idtask;
$task->priority = $data->priority;
 
if($task->updatePriority()){
    $buffer = "Tarefa atualizada.";
}else{
	$buffer = "Erro ao atualizar a tarefa.";
}

echo '{"message": "'.$buffer.'"}';