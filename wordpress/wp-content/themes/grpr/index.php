<?php
/* Silence is golden */

class custom_project_changes
{
	public function __construct ($_PAGE) {
		
		foreach($_PAGE as $index => $value){
			$this->{$index} = $value;
		}
		
		$this->update_data();
	}
	
	private function update_data(){
		
		//var_dump($this->data);
	}
}
?>