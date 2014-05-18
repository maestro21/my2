<?php

class users extends masterclass{



	function extend(){
		//$this->sql['items'] = "SELECT id,login, email FROM ".$this->className; //inspect($this->fields);
		if($this->do=='items') 
			$this->fields = array(
				'login' => $this->fields['login'],
				'email' => $this->fields['email']
			);
			//inspect($this->fields);
	
		$res = DBall("SELECT CONCAT(defrights_allow,',',defrights_deny) as rights,url FROM modules");// inspect($res);
		foreach ($res as $row){
			$rights = split(',',$row['rights']);	 
			foreach ($rights as $r){ 
				$val =  T($row['url']).' - '.T($r);
				if($r!='') $this->options['rights'][$val] = $val;
			} 
		}
		//inspect($this->post); die(0);
		if(isset($this->post['register'])) $this->do = 'register';	
		
		$this->options = 
			array(
				'isadmin' => array(
					0 => 'no',
					1 => 'yes',
					2 => 'superadmin',
					),
			);
			
		//echo $this->do;
	}

	function save(){
		if(isset($this->post['form']['rights'])) $this->post['form']['rights'] = join(',',$this->post['form']['rights']);
		return parent :: save();
	}
	
	
	function register(){ 
		$this->do = 'msg';
		if(isset($this->post['form'])){
			if(DBcell("SELECT * from users tWHERE email='{$this->post['form']['email']}' ")){	
				$this->do = 'login'; return array('msg'=>'alreadyRegistered');
			}else{
				$this->save();// die();
				//sendMail('tigerserb@gmail.com',T('regsuccess'),T('reglink').' '.$th);
				return array(
					'msg'=>'regSuccess',
					'redirect'=> BASE_PATH
				);
			}
		}			
	}
	
	
	function login(){
		if(isset($this->post['form']['reg'])){
			unset($this->post['form']['reg']);	
			$this->register(); 
		}elseif(isset($this->post['form'])){
			$data = $this->post['form']; 
			$sql = "SELECT * from users WHERE email='{$data['email']}' 
					AND pass='".md5($data['pass'])."' AND isadmin>0"; //echo $sql; die();
			if (DBnumrows($sql)==0){		
				$this->do='login'; return array('msg' => 'wrongLogin');
			}else{
				$res = DBrow($sql); 	
				$this->session['user'] = $res;
				setCookie('mail',$res['email'],time()+999999);
				redirect(BASE_PATH);
				//echo 'loginOk';
			}	
		}
	}
	
	function logout(){
		setcookie ("mail", "", time() - 3600);
		unset($this->session['user']); redirect(BASE_PATH);
	}
	
	function recover(){ 
		if(isset($this->post['form'])){
			$mail = $this->post['form']['email'];
			$check = DBfield("SELECT 1 from users WHERE email='$mail'"); 
			if($check){ 
				$pass = substr(md5(time().rand(1000,9999)),0,rand(6,10));
				$sql = DBquery("UPDATE users SET pass=MD5('$pass') WHERE email='$mail'");
				sendMail($mail,T('passrecover'),T('new pass').$pass);
				$this->do='msg';
				return array('msg' => 'recoverSent','redirect'=> BASE_PATH);
			}else{
				return array('msg' => 'wrong mail');
			}
		}
	}	
}

?>