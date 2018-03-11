<?php

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {       
        $this->model = new Model();
        $this->view = new View(TEMPLATE); 
		
		
        if(isset($_POST['email']))
        {  
			if($this->model->cfCheck())
			{
				$this->model->setForm(true);
				$this->pageSendMail();
			}
			else
			{
				$this->pageSendFail();
			}
		}
        else
        {    
            $this->model->setForm(false);
            $this->pageDefault();   
        }

        $this->view->templateRender();          
    }   

    private function pageSendMail()
    {
        if($this->model->checkForm() === true)
        {
			$this->model->sendEmail();
			$this->model->setForm(false);
        }
        $mArray = $this->model->getArraySucc();     
        $this->view->addToReplace($mArray);  
    }   

	private function pageSendFail()
    {   
        $mArray = $this->model->getArrayFail();     
        $this->view->addToReplace($mArray);            
    }
	
    private function pageDefault()
    {   
        $mArray = $this->model->getArrayDefault();     
        $this->view->addToReplace($mArray);            
    }              
}

