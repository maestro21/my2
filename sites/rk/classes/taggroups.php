<?php

class taggroups extends masterclass{
	
	function save(){
		$this->post['form']['tags'] = join(',',$this->post['form']['tags']);
		return parent :: save();
	}
	
	function getOptions(){
		$res = DBall("SELECT * FROM topics ORDER BY name ASC");	

		foreach ($res as $tag){
			$this->options['tags'][$tag['id']] = $tag['name']; 
		}
	}
}

?>