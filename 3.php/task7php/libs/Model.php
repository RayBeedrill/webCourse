<?php 
class Model
{ 
	private $form;
	private $name;
	private $email;
	private $subject;
	private $msg;
	private $placeholderArray;
	
	public function __construct()
	{
		$this->form = false;
		$this->placeholderArray = array(
									'%TITLE%'=>TITLE, 
									'%MESSAGES%'=>'',
									'%MSG-CLASS%'=>'',
									'%OPTION-0%'=>'',
									'%OPTION-1%'=>'',
									'%OPTION-2%'=>'',
									'%OPTION-3%'=>'',
									'%NAME%'=>'',
									'%EMAIL%'=>'',
									'%MSG%'=>'',
									'%SELECT_TEXT_0%'=>SELECT_TEXT_0,
									'%SELECT_TEXT_1%'=>SELECT_TEXT_1,
									'%SELECT_TEXT_2%'=>SELECT_TEXT_2,
									'%SELECT_TEXT_3%'=>SELECT_TEXT_3,
									);  
	}

		
	public function getArrayDefault()
	{        
		return $this->placeholderArray;
	}
	
	public function getArraySucc()
	{        
		$arr = $this->placeholderArray;
		$arr['%MESSAGES%'] = MSG_SUCC;
		$arr['%MSG-CLASS%'] = MSG_CLASS_SUCC;
		return $arr;
	}
			  
	public function getArrayFail()
	{        
		$this->saveInputsVal();
		$arr = $this->placeholderArray;
		$arr['%MESSAGES%'] = MSG_FAIL;
		$arr['%MSG-CLASS%'] = MSG_CLASS_FAIL;
		return $arr;
	}
	
	public function selectCheck($val)
	{
		
		if($val === "0")
		{
			return $var = false; 
		}
		else
		{
			return $var = $val;
		}
	}
	
	public function inputCheck($val)
	{
		if(isset($val) && strlen($val) > 0)
		{
			$val = trim(strip_tags($val));
			return $val;
		}
		else
		{
			return $val = false;
		}
		
	}
	
	public function cfCheck()
	{
		$email = $this->inputCheck($_POST['email']);
		$msg = $this->inputCheck($_POST['msg']);
		$name = $this->inputCheck($_POST['name']);
		$subject = $this->selectCheck($_POST['subject']);
		
		$this->setEmailValue($email);
		$this->setNameValue($name);
		$this->setSubjectValue($subject);
		$this->setMsgValue($msg);
		
		if($email && $msg && $name && $subject)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
	public function checkForm()
	{
		return $this->form;           
	}
	
	public function getNameValue()
	{
		return $this->name;
	}
	
	public function getSubjectValue()
	{
		return $this->subject;
	}
	
	public function getSubjectText()
	{
		$subject = $this->subject;
		switch($subject)
		{
			case '1':
			$subject = SELECT_TEXT_1;
			break;
			case '2':
			$subject = SELECT_TEXT_2;
			break;
			case '3':
			$subject = SELECT_TEXT_3;
			break;
		}
		return $subject;
	}
	
	public function getEmailValue()
	{
		return $this->email;
	}
	
	public function getMsgValue()
	{
		return $this->msg;
	}
	
	public function setNameValue($val)
	{
		$this->name = $val;
	}
	
	public function setSubjectValue($val)
	{
		$this->subject = $val;
	}
	
	public function setEmailValue($val)
	{
		$this->email = $val;
	}
	
	public function setMsgValue($val)
	{
		$this->msg = wordwrap($val, 70, "\r\n");
	}
	
	public function setForm($val)
	{
		$this->form = $val;
	}
	
	public function saveInputsVal()
	{
		$subject = $this->getSubjectValue();
		$name = $this->getNameValue();
		$email = $this->getEmailValue();
		$msg = $this->getMsgValue();
		
		switch($subject)
		{
			case '1':
			$this->placeholderArray['%OPTION-1%'] = "selected";
			break;
			case '2':
			$this->placeholderArray['%OPTION-2%'] = "selected";
			break;
			case '3':
			$this->placeholderArray['%OPTION-3%'] = "selected";
			break;
		}
		$this->placeholderArray['%NAME%'] = $name;
		$this->placeholderArray['%EMAIL%'] = $email;
		$this->placeholderArray['%MSG%'] = $msg;
	}
	
	public function sendEmail()
    {
    date_default_timezone_set('Europe/Kiev');
    $subject = $this->getSubjectText();
	$name = $this->getNameValue();
	$email = $this->getEmailValue();
	$msg = $this->getMsgValue();

    $to = SEND_TO_EMAIL;

    $message = 'Name: ' . $name . "\r\n" .
    'Subject: ' . $subject . "\r\n" .
    'E-mail: ' . $email . "\r\n" .
    'Message: ' . $msg . "\r\n" .
    'Ip-adress:' . $_SERVER['REMOTE_ADDR'] . "\r\n" .
    'Date: ' . date('l jS \of F Y h:i:s A');
    	
	$headers = 'From: ' . $email  . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
	'Content-type: text/html; charset=utf-8\r\n'; 

		if(mail($to, $subject, $message, $headers))
		{
            $this->form =false;
		}
		else
		{
			die(SEND_FATAL);
		}
    
	}

}
