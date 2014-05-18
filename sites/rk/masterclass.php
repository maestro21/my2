<?php

class masterclass{
  	public $id;
	public $className;
	public $get;
	public $post;
	public $limit;
	public $content = '';
	public $do = '';
	public $fields = '';
	public $options = '';
	public $page = 0;
	public $perpage = 10;
	public $pages = 1;
	public $prefix = BASE_PATH; //'?q=';
	public $sql = array();
	public $tpl = 'default';
	public $adminMode = false;
	public $params = array();
	public $orderby = '';
	public $rights = array();
	public $files = '';
	public $defmethod = 'items';
	public $btns;


  	function __construct(){
  		global $_GET, $_POST, $_SESSION, $_PATH, $_FILES;
  		$this->get = & $_GET;
  		$this->post = & $_POST;
		$this->session = & $_SESSION;
		$this->path = & $_PATH;
		$this->files = & $_FILES;
		$this->className =  (@$_PATH[0]!=''?$_PATH[0]:'default'); //get_class($this);
		$this->do =  (@$_PATH[1]!=''?$_PATH[1]:''); 
		$this->id = (isset($this->post['id'])?$this->post['id']:@$_PATH[2]);
		$this->page = (int)@$_PATH[2];
		$this->search = @$_PATH[3];
		$this->tpl = (file_exists( "tpl/".$this->className.".html")?$this->className:$this->tpl);
		$this->sql =$this->sqlSettings();
		$this->fields = $this->getFields();
		$this->getRights();
		$this->getOptions();
		$this->getBtns();
		$this->extend();
		$this->preParse();
		
  	}
	
	function getRights(){
		$this->rights = array(
			'items' => 3,
			'item' => 3,
			'save' => 3,
			'del' => 3,	
			'view' => 3,
			'default' => 3,
		);
	}
	
	function getBtns(){
		$class = $this->className;
		$this->btns = "<a href='javascript:void(0)' onclick=\"conf('".BASE_PATH."$class/ini')\">".T('ini')."</a>   
					<a href='".BASE_PATH."$class/items'>".T('list')."</a> 
					<a href='".BASE_PATH."$class\/item'>".T('add')."</a>";
		
	}
	
	function sqlSettings(){
		return array(
				'checktable' => "show tables like '".$this->className."'",
				'count' => "SELECT count(id) FROM ".$this->className,
				'items' => "SELECT * FROM ".$this->className,
				'item' => "SELECT * FROM ".$this->className." WHERE id='".$this->id."'",
				'update' =>"UPDATE ".$this->className." SET %s WHERE  id='".$this->id."'",
				'insert' => "INSERT INTO ".$this->className." SET %s",
				'delete' => "DELETE  FROM ".$this->className." WHERE id='".$this->id."'",
				'fields' => "SHOW COLUMNS FROM ".$this->className,
				
			);	
	}
	
	
	function checkClass(){
		return DBfield($this->sql["checktable"]) OR $this->do=='ini';
	}	
	
	function checkRights(){ 
		//echo $this->rights[$this->do]; echo $this->session['user']['isadmin'];
		//var_dump($this->rights[$this->do] <= $this->session['user']['isadmin']); 
		//die();
		
		if(superAdmin()) return true;
		
		if($this->rights[$this->do] <= $this->session['user']['isadmin']) return true;

		return (bool)($this->rights[$this->do] <= $this->session['user']['isadmin']);
		
	}
	
	function getFields(){	
		$_F = array(); 
	//	$f = split("\r",trim(DBfield("SELECT fields FROM modules WHERE url='".$this->className."'"))); 	//inspect($f);
		if($f = @file("ini/{$this->className}.txt")){			
			foreach ($f as $v){				
				$tmp = split(" ",$v); 
				$_F[trim(@$tmp[0])] = array( 
					'name' => trim(@$tmp[0]),
					'type' => trim(@$tmp[1]),
					'widget' => trim(@$tmp[2]),
				);		
			}
		}
		return $_F;
				
	}

	function search(){ //die('11');
		$cc = '';
		if($this->search!=''){
			$tmp = array();
			foreach($this->fields as $k=>$v){
				$tmp[] = "`$k` LIKE '%{$this->search}%'";
			}
			$cc .=" WHERE ".join(" OR ",$tmp);			
		}
		$this->pages = ceil(DBfield($this->sql['count'].$cc) / $this->perpage);
		
		$c = split("_",getVar('sort_'.$this->className)); 
		if(isset($this->fields[$c[0]]) && ($c[1]=='ASC' || $c[1] == 'DESC')) $cc .=" ORDER BY `{$c[0]}` ".$c[1];
		if($this->page>0) $this->page--;
		$cc .=$this->orderby." LIMIT ".$this->page*$this->perpage.",".$this->perpage; 
		//echo $this->sql['items'].$cc;
		return DBall($this->sql['items'].$cc);
  	}
	
	
  	function items(){
		$cc = '';
		if($this->search!=''){
			$tmp = array();
			foreach($this->fields as $k=>$v){
				$tmp[] = "`$k` LIKE '%{$this->search}%'";
			}
			$cc .=" WHERE ".join(" OR ",$tmp);			
		}
		$this->pages = ceil(DBfield($this->sql['count'].$cc) / $this->perpage);
		
		$c = split("_",getVar('sort_'.$this->className)); 
		if(isset($this->fields[$c[0]]) && ($c[1]=='ASC' || $c[1] == 'DESC')) $cc .=" ORDER BY `{$c[0]}` ".$c[1];
		if($this->page>0) $this->page--;
		$cc .=$this->orderby." LIMIT ".$this->page*$this->perpage.",".$this->perpage; 
		//echo $this->sql['items'].$cc;
		return DBall($this->sql['items'].$cc);
  	}


	
     function item(){	
		if($this->id>0){ 
			return DBrow($this->sql['item']);
		}
		else{
			$ret = array_flip(DBcol($this->sql['fields']));
			foreach ($ret as $k =>$v) $ret[$k] = '';
			return $ret;		
		}	
     }
     
     function view(){
		return DBrow($this->sql['item']);
     }
     
     //достать все опции селекта и радио
     function getOptions(){  //продумать
	$this->options = 
		array(
			'sex' => array(
				0 => 'M', 
				1 => 'F',
				),
			'country' => array(
				0 => 'ru',
				1 => 'lv',
				2 => 'eu',
				)
			);
     }
     
     //добавить выборку
     function setOptions($option,$val = array()){
	$this->options[$option] = $val;
     }
     
     //сохранить
     function save(){	//die(inspect($this->post));
     	$res = ''; $tmp = array(); // die(inspect($this->post));
     	 foreach ($this->post['form'] as $k=>$v){
		if($this->fields[$k]['type']=='pass' && trim($v)=='') continue;
     	 	$tmp[] = "$k='".sqlFormat($this->fields[$k]['type'],$v)."'";
     	 } 
		 
	 $data = join(",",$tmp); //inspect($data); die();
	 if($this->id>0){ 
		$sql = sprintf($this->sql['update'],$data); 
		return DBquery($sql);
	 }else{ 	
		$sql = sprintf($this->sql['insert'],$data);
		$ret = DBquery($sql);
		if($ret) $this->id = DBinsertId();// die(inspect($this->id));
		return $ret;
	 }         
     }

     
     //удалить
     function del(){
        return DBquery($this->sql['delete']);
     }

	function preParse(){ 
		$do =  $this->do; if($do == '') $do = $this->do = $this->defmethod; $data = ''; 

		//if($this->checkRights()) echo "true"; else echo "false";

		if($this->checkClass() AND $this->checkRights()){   
			if(method_exists($this,$do)){ 
				$data = $this->$do(); 
				if(isset($data['id'])) unset($data['id']);
				//inspect($data); die();
			}		
			//inspect($this->params);	
			$this->params['class']=$this->className;	
			$this->params['do']=$this->do; 
			$this->params['id']=$this->id;
			$this->params['pre']=$this->prefix;    //префикс перед запросом. На случай если не пашет .htaccess
			$this->params['data']=$data;
			$this->params['fields']=$this->fields;
			$this->params['p']=$this->page;
			$this->params['pages']=$this->pages;
			$this->params['search']=$this->search;
			$this->params['options']=$this->options;
			$this->params['rights']= $this->rights;
			//inspect($this->params); die();
		}
	}
     
     // выводит содержимое
     function parse(){ 
		$this->content = tpl( $this->tpl , $this->params,$this->adminMode);			
		return $this->content;
     }
     
     
     
     // инсталляция
     function ini(){		
	$sql = "DROP TABLE IF EXISTS `{$this->className}`";
	DBquery($sql) or die (mysql_error() . $sql);	
	
	$sql = "CREATE TABLE `{$this->className}`(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
			foreach ($this->fields as  $field){
				$type = '';
				switch($field['type']){
					case 'pass' :
					case 'text': $type = ' TEXT'; break;
					case 'int' : $type = ' INT DEFAULT 0'; break;
					case 'date' : $type = ' TIMESTAMP DEFAULT CURRENT_TIMESTAMP'; break;
					case 'float' : $type = ' FLOAT DEFAULT 0'; break;					
				}
				//echo $type. ' '.$tmp[0];
				if($type!='' && $field['name']!='') $sql .= ",`".$field['name']."` $type";
			}
	$sql.=	");";
	DBquery($sql) or die (mysql_error() . $sql);	
	
	return true;	
     }

	//пустая функция для расширения наследниками, вызывается в конце __construct
	function extend(){}		

	
}


class tree{
	var $treeTMPList = Array(); //МАССИВ ДЕТЕЙ
	var $treeList = Array(); //МАССИВ ДЕРЕВА
	var $options = Array('---');
	
	function fetch($data){
		//inspect($data);
		foreach ($data as $k=>$row){	
			foreach ($row as $k=>$v) $this->treeTMPList[$row['id']][$k] = $v; //writing data to current element
			$this->treeTMPList[$row['pid']]['_children'][] = $row['id']; // grouping all children;						
		}
		//inspect($this->treeTMPList);
		
		$this->treeList	= $this->branch(0); //building array
		//inspect($this->treeList);
		return $this->treeList;
	}

	function branch($id) //returns single branch based on parent id
	{
		$tmpArr = Array();
	
		//echo $id .'=>';print_r($this->treeTMPList[$id]['_children']);
		if(sizeof(@$this->treeTMPList[$id]['_children'])>0)
			foreach ($this->treeTMPList[$id]['_children'] as $child)
			{					
				$tmpArr[$child] = $this->treeTMPList[$child];
				unset($tmpArr[$child]['_children']);
				$tmpArr[$child]['children'] = $this->branch($child);			
			}	
		
		return $tmpArr;		
	}
	
	
	function fetchDraw($data,$lvl=-1){
		 $lvl++;
		foreach ($data as $row){
			for($i=0;$i<$lvl;$i++) $row['name'] ="--".$row['name'];
			$this->options[$row['id']] = $row['name'];
			if($row['children']!='') $this->fetchDraw($row['children'],$lvl);
		}
	}
}

?>