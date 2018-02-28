<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
		
		
		
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID\
		$data_from_file = file_get_contents('Task_data.txt');
		$data = json_decode($data_from_file,true);
		$index =  count($data);
		array_map('current',$data);//convert two dimensional into one dimensional
		sort($data);  //sort the data into asc
		$rec = $data[$index-1];
		$last_id = $rec['TaskId'];
		$new_id = $last_id + 1;
        return $new_id; // Placeholder return for now
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
			
			
        } else
            return null;
    }

    public function Save() {
        //Assignment: Code to save task here
		$data_from_file = file_get_contents('Task_data.txt');
		$data = json_decode($data_from_file,true);
		if($this->TaskId == -1 )//insert 
		{
			$data[] = array('TaskId'=>$this->getUniqueId(),'TaskName'=>$this->TaskName,'TaskDescription'=>$this->TaskDescription);
				
		}
		else //update
		{
			$data = array_map('array_merge', $data);
			$index = array_search("{$this->TaskId}", array_column($data, 'TaskId'));
			$data[$index]['TaskName'] = $this->TaskName;
			$data[$index]['TaskDescription'] = $this->TaskDescription;
						
		}
		$data = json_encode($data,true);
		file_put_contents('Task_data.txt',$data);
		
    }
    public function Delete() {
        //Assignment: Code to delete task here
		
		$data_from_file = file_get_contents('Task_data.txt');
		$data = json_decode($data_from_file,true);

		$index = array_search("{$this->TaskId}", array_column($data, 'TaskId'));
		echo $this->TaskId . "|". $index;
		unset($data[$index]);
		$data = json_encode($data,true);
		file_put_contents('Task_data.txt',$data);
		
    }
	
	
}
?>