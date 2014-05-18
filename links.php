<?php

class links extends masterclass{
	
	
	function extend(){
		$this->perpage=100;
		$this->tpl='links';	
		if(isset($this->post['form']['url'])) $this->post['form']['url'] = str_replace('http://','',$this->post['form']['url']);
	}
	
	function items(){
	
		$tagSQL = "SELECT tag, COUNT( t.tag ) AS total
				FROM linktags t
				JOIN links l ON t.link_id = l.id
				GROUP BY t.tag
				ORDER By total DESC";
		$this->params['tagcloud'] = DBall($tagSQL);
		//inspect($this->params['tagcloud']);
		$tag = @$this->path[3];
		$this->sql['count'] = "SELECT count(l.id) FROM links l";
		$this->sql['items'] = "SELECT l.*, GROUP_CONCAT(t.tag) as tags FROM links l LEFT JOIN linktags t ON l.id=t.link_id";
		
		if($tag!=''){
			$this->sql['items'] .= "  JOIN linktags tt ON tt.link_id = l.id AND tt.tag='$tag'"; 
			$this->sql['count'] .= "  JOIN linktags t ON t.link_id = l.id AND t.tag='$tag'";
		}
		
		
		$this->sql['items'] .=" GROUP BY l.id ORDER BY `date` DESC";	
		//echo 	$this->sql['items']; //die();
		
		$this->pages = ceil(DBfield($this->sql['count'].$cc) / $this->perpage);
		
		$c = split("_",getVar('sort_'.$this->className)); 
		if(isset($this->fields[$c[0]]) && ($c[1]=='ASC' || $c[1] == 'DESC')) $cc .=" ORDER BY `{$c[0]}` ".$c[1];
		if($this->page>0) $this->page--;
		$cc .=$this->orderby." LIMIT ".$this->page*$this->perpage.",".$this->perpage; 
		//echo $this->sql['items'].$cc;
		return DBall($this->sql['items'].$cc);
		
		
		/*$tree = new tree();
		return $tree->fetch(DBall("SELECT * from links ORDER BY pid ASC, pos ASC"));*/
	
	}	

	function item(){
	
			$data = parent :: item();
			$data['tags'] = DBcell( "SELECT GROUP_CONCAT(tag) FROM linktags WHERE link_id='{$this->id}'" );	
			return $data;		

		/*
		$tree = new tree();				
		$tree->fetchDraw($tree->fetch(DBall("SELECT id, pid, label as name from links WHERE id!='".$this->id."' ORDER BY pid ASC, pos ASC")));	
		$this->options['pid'] = $tree->options; */
		
	//	return	parent :: item();
	}

	function save(){
		$check = DBcell("SELECT 1 FROM links WHERE url LIKE '%{$this->post['form']['url']}'"); //die($check);
		if($check < 1 || $this->id > 0){
			$tags = $this->post['form']['tags']; //die(inspect($tags));
			unset($this->post['form']['tags']);			
			parent :: save();
			
			$taglist = split(',',$tags);
			$sql = "DELETE FROM linktags WHERE link_id='{$this->id}'";
			DBquery($sql);// echo $sql;
			if($taglist[0] != ''){
				foreach ($taglist as $tag){
					$tag = trim($tag);	
					$sql = "INSERT INTO	linktags SET link_id='{$this->id}', tag='$tag'";
					DBquery($sql); //echo $sql;
				}
			}
		}
	}
	
}

?>