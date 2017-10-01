<?php

class custom_admin_project_changes
{
	public function __construct ($_FIELDS) {
		
		foreach($_FIELDS as $index => $value){
			$this->{$index} = $value;
		}
		
		$this->update_data();
	}
	
	private function update_data(){
		
		var_dump($this);
	}
	
	public function update_field_tests($tests){
		
		
		
		return $tests;
	}
	
	public function update_field_html($field_html){
		
//		$field_html["text"] = function($attr,$value,$fieldname,$existing) {
//
//
//			$attr_title = ucfirst(str_replace("_"," ",$attr)); // Nice title for display purposes
//
//
//			if(isset($existing[$attr]))
//				$value = $existing[$attr];
//
//			$html = '<label>'.$attr_title.'2:</label>';
//			//$html .= isset($comment) ? "<p class='comment'>".$comment."</p>" : "";
//			$html .= '<input type="'.$fieldtype.'" name="'.$fieldname.'['.$attr.']" value="'.$value.'" />';
//			return $html;
//		};
//		
		return $field_html;
	}
	public function update_block_html($block_html){
		
		
		
		return $block_html;
	}
}

?>