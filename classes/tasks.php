<?php

class tasks extends masterclass{
	public $projects = '';
	function extend(){
		if(@$this->session['project']>0) $this->sql['items'] .=" WHERE pid='".$this->session['project']."'";
		$this->sql['items'] .= " ORDER BY status DESC, created desc";
		$this->tpl='tasks';
		$this->perpage=100;
		
		$tmp = DBall("SELECT * FROM  projects"); $this->projects[0] = T('all');
		foreach ($tmp as $v){
			$this->projects[$v['id']] = $v['name'];
		}
		$this->params['statuses'] = $this->options['status'] = Array ( T('closed'),T('open'),T('urgent') );	
		$this->params['projects'] = $this->options['pid'] = $this->projects; //inspect($this->params['projects']);
			
	}
	
}

?>