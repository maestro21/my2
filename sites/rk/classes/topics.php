<?php

class topics extends masterclass{
	
	function extend(){
		$this->perpage=50;
		$this->sql['items'] .= " ORDER BY name ASC";
		$this->btns .="<a href='".BASE_PATH.$this->className."/importtags'><img src='".BASE_PATH."img/import_xsml.png' align='absmiddle' text='Добавить темы' alt='Добавить темы' title='Добавить темы'></a>";
	}
	
	function savetags(){
		$tags = split("\n",$this->post['tags']);
		foreach ($tags as $k=>$v){
			$tags[$k] = rus2url($v);
			$sql = "INSERT INTO topics SET name='$v', url='".rus2url($v)."'";
			DBquery($sql);
		}
		redirect(BASE_PATH.'topics');
		//inspect($tags); die();
	}
}

?>