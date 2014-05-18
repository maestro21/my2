<?php

class records extends masterclass{


	function extend(){
		global $_PATH;
		$this->orderby = " ORDER BY `date` DESC";
		$this->perpage = 20;
		$id = (int)@$_PATH[5]; //echo $this->do;
		
		//$this->sql['count'] .=" WHERE blog_id=$id";
		
		if(isset($_PATH[6])){
			$this->className = $_PATH[6];
			$this->params['title'] = DBcell("SELECT name from blogs WHERE id=$id"); 
		}	
		
		$res = DBall("SELECT * from topics"); $tags= array();
		foreach ($res as $row)
			$tags[$row['id']] = $row;
			
		$res = DBall("SELECT * from taggroups"); $groups=array();
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
	
		$id = (int)@$this->path[5];


		
		$sql = "SELECT r.* FROM records r, tags t
				WHERE  r.blog_id=$id";
				
		if($tag){
			$_sql = "SELECT * FROM topics WHERE url LIKE '%{$this->id}%'";
			$this->session['tag'] = DBrow($_sql);
			$tag = $this->session['tag']['id'];			
			$sql .=" AND r.id=t.post_id AND t.tag='$tag'";
			if($this->search>0){
				$this->page = $this->search;
			}			
			$this->sql['count'] .=" JOIN tags ON records.id=tags.post_id AND tags.tag='$tag' WHERE blog_id=$id";
		}else{
			$this->sql['count'] .=" WHERE blog_id=$id";
			if($this->search!=''){
				$sql.=" AND ( maintext LIKE '%{$this->search}%' OR text LIKE '%{$this->search}%' OR label LIKE '%{$this->search}%' )";
				$this->sql['count'] .= " AND ( maintext LIKE '%{$this->search}%' OR text LIKE '%{$this->search}%' OR label LIKE '%{$this->search}%' )";
			}
		}
		$this->search = '';
		$sql .=" GROUP BY r.id";
		$this->sql['items'] =  $sql;
		//echo $this->sql['items'];
		//echo $this->sql['count'];
		//echo $sql;
		
	/*	$this->sql['items'] = "SELECT r.*, GROUP_CONCAT(t.tag) as tags FROM records r ";
		
		if($tag)
			$this->sql['items'] .= "  JOIN tags t ON t.post_id = r.id AND t.tag='$tag'"; 
		else
			$this->sql['items'] .=  " LEFT JOIN tags t ON r.id=t.post_id";
		
		if($this->search=='')
			$this->sql['items'] .=" WHERE blog_id=$id";
		else
			$this->orderby = " AND blog_id=$id" . $this->orderby;
		
		$this->sql['items'] .=" GROUP BY r.id";	
		echo 	$this->sql['items'];
		
		$this->sql['count'] .=" WHERE blog_id=$id";*/
		
		return parent :: items();//DBall($this->sql['items']);
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
		 global $blogs;
		 if(isset($blogs)){
			 $this->options['blog_id'] = array( 0 => T('records') ); 
			 foreach ($blogs as $blog){
					$this->options['blog_id'][$blog['id']] = $blog['name']; 
				}
		}
		
		$res = DBall("SELECT * FROM topics ORDER BY name ASC");	

		foreach ($res as $tag){
			$this->options['tags'][$tag['id']] = $tag['name']; 
		}
    }
	

}

?>