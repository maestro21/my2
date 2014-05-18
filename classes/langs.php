<?php
class langs extends masterclass{
	
	function extend(){
		$this->options = 
			array(
				'isactive' => array(
					0 => 'no',
					1 => 'yes',
					),
			);
	}
	
	function save(){
		file_put_contents("lang/{$this->post['form']['abbr']}.txt",$this->post['form']['labels']);
		unset($this->post['form']['labels']); //die();
		return parent :: save();	
	}
	
	function item(){
		$data = parent::item(); 
		$data['labels'] = @file_get_contents("lang/{$data['abbr']}.txt");
		$this->fields['labels'] = array( 'name' => 'labels', 'type'=>'file', 'widget'=>'textarea');
		return $data;
	}

} ?>