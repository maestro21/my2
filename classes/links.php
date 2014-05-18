<?php

class links extends masterclass{
	
	
	function extend(){
		$this->perpage = 100;
		$this->tpl='links';	
		if($this->do == 'getlink') $this->ajax =true;
		if(isset($this->post['form']['url'])) $this->post['form']['url'] = str_replace('http://','',$this->post['form']['url']);
	}
	
	function export() {
		$links = DBall("SELECT * FROM links l");
		$tags  = DBall("SELECT link_id, GROUP_CONCAT(tag) as tags FROM linktags GROUP BY link_id");
		$result = array();
		foreach($links as $link) {
			$result[$link['id']]['link'] = $link['url'];			
		}
		foreach ($tags as $tag) {
			$result[$tag['link_id']]['tags'] = $tag['tags'];
		}
		foreach ($result as $link){
			echo $link['link'] . " " . $link['tags'];
		}
	}
	
	function items(){	
		//$this->updatetags();
		$this->params['tagcloud'] = unserialize(G('tagcloud')); //var_dump(unserialize(G('tagcloud')));
		$tag = @$this->path[3];
		$this->sql['count'] = "SELECT count(l.id) FROM links l";
		$this->sql['items'] = "SELECT l.* FROM links l ";		
		if($tag!=''){
			$this->sql['items'] .= "  JOIN tags_links t ON t.link_id = l.id AND t.tag='$tag'"; 
			$this->sql['count'] .= "  JOIN tags_links t ON t.link_id = l.id AND t.tag='$tag'";
		}
		$this->sql['items'] .=" GROUP BY l.id ORDER BY `date` DESC";	
		
		$this->pages = ceil(DBfield($this->sql['count'].$cc) / $this->perpage);
		
		if($this->page>0) $this->page--;
		$cc .=$this->orderby." LIMIT ".$this->page*$this->perpage.",".$this->perpage; 

		return DBall($this->sql['items'].$cc);
	}
	
	function updatetags() {
		$tagSQL = "SELECT tag, COUNT( t.tag ) AS total
		FROM tags_links t
		JOIN links l ON t.link_id = l.id
		GROUP BY t.tag
		ORDER By total DESC";
		$tagcloud = serialize(DBall($tagSQL));
		$sql = "DELETE from globals WHERE `name`='tagcloud'"; DBquery($sql);
		$sql = "INSERT INTO globals SET `value`='$tagcloud', `name`='tagcloud'"; DBquery($sql);
		getGlobals();
	}

	function save(){
		$check = DBcell("SELECT id FROM links WHERE url LIKE '%{$this->post['form']['url']}'"); //die($check);
		if($check < 1 || $this->id > 0){
			$tags = $this->post['form']['tags']; //die(inspect($tags));
			parent :: save();
			
			$taglist = explode(',',$tags);
			$sql = "DELETE FROM tags_links WHERE link_id='{$this->id}'";
			DBquery($sql);// echo $sql;
			if($taglist[0] != ''){
				foreach ($taglist as $tag){
					$tag = trim($tag);	
					$sql = "INSERT INTO	tags_links SET link_id='{$this->id}', tag='$tag'";
					DBquery($sql); //echo $sql;
				}
			}
			$this->updatetags();
		}
	}
	
	function newlist() {
		/*$sql = "SELECT url FROM links ORDER BY id asc LIMIT 2970, 100";
		$ret = DBcol($sql); */
		$ret = str_replace('<br>','',file('links.txt'));
		return array($ret[76]);//array_slice($ret,101);//,100);
	}
	
	function getlink() {
		$tags = $this->post['tags'];
		$url = parseString($this->post['url']);
		$this->ajax = true;
		if(strpos($url, "http://") === false) $url = "http://" . $url;
		$_url = parse_url($url); 
		$_host = str_replace('www.','',$_url['host']);
		$tags .= ',' .  $_host;
		$key = "rca.1.1.20140217T194504Z.a343e19f66dc557e.e2ec3f817b7dba35a503f25e44051a5eb57e4a0f";
		$result = json_decode(file_get_contents("http://rca.yandex.com/?key=$key&url=$url"),true);
		$mime = explode('/',$result['mime']);
		$response = array();
		$response['result'] = $result;
		$response['code'] = 0;
		switch($mime[0]) {
			case 'image':
				$response['code'] = 1;
				$images = loadClass('images');
				$images->post['form'] = array( 
					'url' =>  $url,
					'tags' => $tags,
				);
				$images->save();
				$response['type'] = 'image';
				$response['image'] = $images->item();
			break;

			case 'text':
				$response['code'] = 2;
				$data = array(
					'title' 		=> $result['title'],
					'description' 	=> $result['content'],
					'tags'			=> $tags,
					'url'			=> $url
				);
				$response['type'] = 'link';
				$this->post['form'] = $data;
				$this->save();
				$response['debug']['news-id'] = $this->id;
				if($result['img']){	
					$images = loadClass('images');
					$response['images'] = array();	
					foreach($result['img'] as $img) {
						$images->post['form'] = array( 
							'url' 		=> $img,
							'tags' 		=> $tags,
							'link_id' 	=> $link->id,
							'album_id'	=> 1,
							'title'		=> $result['title'],
						);
						$images->post['host'] = $_host;
						$images->save();
						$response['debug']['images_id'][] = $images->id;
						if(!$data['img']) {
							$data['img'] = $images->id;
							DBquery("UPDATE links SET img='{$images->id}' WHERE id='{$this->id}'");
						}
						$response['images'][] = DBrow("SELECT * from images WHERE id='{$images->id}'");
					}
				}		
				if($result['video']){	
					$videos = loadClass('videos');
					$response['video'] = array();	
					foreach($result['video'] as $video) {
						$videos->post['form'] = array( 
							'url' 		=>  parseString($video['url']),
							'duration' 	=>	$video['duration'],
							'tags' 		=>  $tags,
							'link_id' 	=>  $pid,
							'title'		=>  $result['title'],
						);
						$videos->post['img'] = $img;
						$videos->save();
						$response['video'][] = DBrow("SELECT * from videos WHERE id='{$videos->id}'");
					}
				}
				$response['url'] = DBrow("SELECT * from links WHERE id='{$this->id}'");
			break;
		}
		//logwrite('linkimport', print_r($response,true));
		return $response;
	}
	
	function del(){
		DBquery("DELETE FROM tags_links WHERE link_id={$this->id}");
		parent :: del();
		$this->updatetags();
	}
	
}

?>