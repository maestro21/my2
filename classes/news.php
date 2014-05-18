<?php

class news extends masterclass{


	function extend(){
		global $_PATH;
		$this->orderby = " ORDER BY `date` DESC";
		$this->perpage = 20;
		$id = (int)@$_PATH[5]; //echo $this->do;
		
		//$this->sql['count'] .=" WHERE blog_id=$id";
		
		$res = DBall("SELECT * from newstopics"); $tags= array();
		foreach ($res as $row)
			$tags[$row['id']] = $row;
			
		$res = DBall("SELECT * from newstopicgroups"); $groups=array();
		foreach($res as $group){
			$groups[$group['id']] = array('name' => $group['name'] ,'tags' => array());
			$_tags = split(',',$group['tags']);
			foreach ($_tags as $tag){
				$groups[$group['id']]['tags'][] = $tags[$tag];
			}
		}		
			
		$this->params['tags'] =$groups;
		
		$this->session['tag'] = array( 'id' => 0, 'bgcolor' => 'black', 'color' =>'white', 'url'=>'rus', 'name'=>'Русский Клуб');
		
		$this->rights['view']=0;
		$this->rights['items']=1;
		$this->rights['default']=0;
	}
	
	function tag(){// echo "111";
		return $this->items(true);
	}
	
	function search(){
		return $this->items(false);
	}
	
	function items($tag = false){
		
		$sql = "SELECT r.* FROM news r, tags t";
				
		if($tag){
			$_sql = "SELECT * FROM newstopics WHERE url LIKE '%{$this->id}%'";
			$this->session['tag'] = DBrow($_sql);
			$tag = $this->session['tag']['id'];			
			$sql .=" AND r.id=t.post_id AND t.tag='$tag'";
			if($this->search>0){
				$this->page = $this->search;
			}			
			$this->sql['count'] .=" JOIN newstopics nt ON news.id=nt.post_id AND nt.tag='$tag'";
		}else{
			if($this->search!=''){
				$sql.=" AND ( maintext LIKE '%{$this->search}%' OR text LIKE '%{$this->search}%' OR label LIKE '%{$this->search}%' )";
				$this->sql['count'] .= " AND ( maintext LIKE '%{$this->search}%' OR text LIKE '%{$this->search}%' OR label LIKE '%{$this->search}%' )";
			}
		}
		$this->search = '';
		$sql .=" GROUP BY r.id";
		$this->sql['items'] =  $sql;
		
		
		return parent :: items();
	}
	
	function view(){		
		return $this->item();	
	}
	
	function item(){		
		$data = parent :: item();
		$data['tags'] = DBcell( "SELECT GROUP_CONCAT(tag) FROM tags WHERE post_id='{$this->id}'" );	
		return $data;		
	}
	
	function save(){
		$taglist = $this->post['form']['tags']; //die(inspect($tags));
		$this->post['form']['tags'] = join(',',$this->post['form']['tags']);
		parent :: save();

		$sql = "DELETE FROM tags WHERE post_id='{$this->id}'";
		DBquery($sql);// echo $sql;
		if($taglist[0] != ''){
			foreach ($taglist as $tag){
				$tag = trim($tag);	
				$sql = "INSERT INTO	tags SET post_id='{$this->id}', tag='$tag'";
				DBquery($sql); //echo $sql;
			}
		}
	}
	
	function getOptions(){ 
		$res = DBall("SELECT * FROM newstopics ORDER BY name ASC");	

		foreach ($res as $tag){
			$this->options['tags'][$tag['id']] = $tag['name']; 
		}
    }
	

}

?>