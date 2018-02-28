<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script

/*
{'InputTaskName':InputTaskName,
								'InputTaskDescription':InputTaskDescription,
					indicator			'TaskId': currentTaskId
*/

$data = array();

if(isset($_POST['InputTaskDescription']))
{
	$TaskDescription = $_POST['InputTaskDescription'];
}
if(isset($_POST['InputTaskName']))
{
	$TaskName = $_POST['InputTaskName'];
}
if(isset($_POST['indicator']))
{
	$indicator = $_POST['indicator'];
}
if(isset($_POST['TaskId']))
{
	$TaskId = $_POST['TaskId'];
}
$newTask = new Task();//instantiate task object
switch($indicator)
{
	case -1:
	
		$newTask->TaskId = $TaskId ;
		$newTask->TaskName = $TaskName;
		$newTask->TaskDescription = $TaskDescription;
		$newTask->save();
		$data[] = "Successfully created ";
		
		break;//create
	case -2:
		$newTask->TaskId = $TaskId;
		$newTask->TaskName = $TaskName;
		$newTask->TaskDescription = $TaskDescription;
		$newTask->save();
		$data[] = "Successfully updated";
		
		break;//updates
	case -3:
		
		$newTask->TaskId = $TaskId;
		$newTask->Delete();
		
		$data[] = "Successfully deleted";
		break;//delete
}

echo json_encode($data);
?>