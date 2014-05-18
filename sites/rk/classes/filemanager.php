<?php
class filemanager extends masterclass{
	
	public $fpath = '';
	
	function checkClass(){ return true; }
	
	function extend(){
		$_t = $this->path; unset($_t[0]);
		$rm = true; 
		//if(in_array(@$_t[1],array('del','save','item','items','mkdir'))){ unset($_t[1]); $rm = false; }
		if(method_exists($this,@$_t[1])){ unset($_t[1]); $rm = false; }
		$this->id = $this->fpath = @join('/',$_t); //echo $this->fpath;

		if($rm){
			if(file_exists($this->fpath))
				if(is_dir($this->fpath))
					$this->do = 'items';
				else
					$this->do = 'item';
		}
		//echo $this->do;
	}
	
	function items(){
		$dir = scandir('./'); unset($dir[0]);unset($dir[1]);
		$popdirs = array_flip(array ( 'classes','tpl','img','lang','ini'));
		$sdirs = array(); //system directories
		$udirs = array(); //user directories
		foreach ($dir as $file){
			if(is_dir($file)){
				if(isset($popdirs[$file]))
					$sdirs[] = $file;
				else
					$udirs[] = $file;
			}		
		}
		
		
		$dir = scandir('./'.$this->fpath); unset($dir[0]);unset($dir[1]);
		$files = array();
		$dirs = array();
		foreach ($dir as $file){
			if(is_dir('./'.$this->fpath.'/'.$file))				
				$dirs[] = $file;
			else
				$files[] = $file;
		}
		
		$data = array (
			'system_dirs' => $sdirs,
			'user_dirs' => $udirs,
			'files' => $files,
			'dirs' => $dirs,
			'path' =>split('/',$this->fpath),
		);
		//inspect($data);
		return $data;
		//$files = 
	
	}

	function getFile(){ //die('11');
		echo (is_file($this->fpath) ? file_get_contents($this->fpath) : ''); die();
	}
	
	function item(){		
		$data = array( 
			'path'=> $this->fpath,
			'content' => ''//(is_file($this->fpath) ? file_get_contents($this->fpath) : ''),
		);
		return $data;
	}
	
	function save(){
		inspect($this->post);  
		file_put_contents($this->post['form']['path'],$this->post['form']['content']);
		$this->id = $this->post['form']['path'];
		die();
	}
	
	function del(){
		//die();
		if(is_dir('./'.$this->fpath)) 
			rmdir('./'.$this->fpath);
		else 
			unlink('./'.$this->fpath);
	}
	
	function newdir(){
		if(!file_exists('./'.$this->fpath)){
			mkdir('./'.$this->fpath); $data['msg'] = T('directory created');
		}else
			$data['msg'] = T('directory exists');
		return $data;
	}

	function fcopy(){
		if($this->post['del'] == 1)
			rename('./'.$this->post['from'],'./'.$this->post['to']);
		else
			copy('./'.$this->post['from'],'./'.$this->post['to']);
	}

	function upfile(){
		//inspect($this->files['file']); die();
		if(move_uploaded_file($this->files['file']['tmp_name'], $this->post['path'].'/'.$this->files['file']['name'])) {
			$data['msg'] = T('Upload success');
		} else{
			$data['msg'] = T('Upload failed');
		}
		$this->id = $this->post['path'];
		return $data;
	}	
	
}
?>