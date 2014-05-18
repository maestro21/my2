<?php
class modules extends masterclass{

	 function extend(){  //продумать
		$this->options = 
			array(
				'isactive' => array(
					0 => 'no',
					1 => 'yes',
					),
				'defrights' => array(
					0 => 'no',
					1 => 'yes',
					)
			);
     }
	 
	function save(){
		file_put_contents("ini/{$this->post['form']['url']}.txt",$this->post['form']['fields']);
		unset($this->post['form']['fields']); //die();
		return parent :: save();	
	}
	
	function item(){
		$data = parent::item();
		$data['fields'] = @file_get_contents("ini/{$data['url']}.txt");
		$this->fields['fields'] = array( 'name' => 'fields', 'type'=>'file', 'widget'=>'textarea');
		return $data;
	}


}

?>