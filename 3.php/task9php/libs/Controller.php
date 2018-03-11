<?php

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {       
        $this->model = new Model();
        $this->view = new View(TEMPLATE); 

       
        $radioBtn1 = HtmlHelper::radioButtonsCreate(array('name'=>'firstRb','value'=>'1','id'=>'rb1','inline'=>true,'text'=>'radio button 1','checked'=>true));
        $radioBtn2 = HtmlHelper::radioButtonsCreate(array('name'=>'firstRb','value'=>'2','id'=>'rb2','inline'=>true,'text'=>'radio button 2','checked'=>false));
        $radioBtn3 = HtmlHelper::radioButtonsCreate(array('name'=>'firstRb','value'=>'3','id'=>'rb3','inline'=>true,'text'=>'radio button 3','checked'=>false));

        $checkBox1 = HtmlHelper::checkBoxCreate(array('name'=>'firstChb','value'=>'1','id'=>'chb1','inline'=>true,'text'=>'checkbox 1','checked'=>true));
        $checkBox2 = HtmlHelper::checkBoxCreate(array('name'=>'firstChb','value'=>'2','id'=>'chb2','inline'=>true,'text'=>'checkbox 2','checked'=>false));
        $checkBox3 = HtmlHelper::checkBoxCreate(array('name'=>'firstChb','value'=>'3','id'=>'chb3','inline'=>true,'text'=>'checkbox 3','checked'=>false));

        $list1 = HtmlHelper::listCreate(array('ordered'=>true,'inline'=>false,'class'=>'some class'),array('1 value','2 value','3 value'));
        $list2 = HtmlHelper::listCreate(array('ordered'=>false,'inline'=>true,'class'=>'some class'),array('1 value','2 value','3 value'));
        $description1 = HtmlHelper::descriptionCreate(array(),array('header 1'=>'text','header 2'=>'text','header 3'=>'text'));
        $description2 = HtmlHelper::descriptionCreate(array('horizontal'=>true),array('header 1'=>'text','header 2'=>'text','header 3'=>'text'));
        $select1 = HtmlHelper::selectCreate(array(),array('1 value','2 value','3 value'));
        $select2 = HtmlHelper::selectCreate(array('multiple'=>true),array('1 value','2 value','3 value'));

		$table = array();
		$table[0][0] = '1 value';
		$table[0][1] = '2 value';
		$table[0][2] = '3 value';
		$table[1][0] = '4 value';
		$table[1][1] = '5 value';
		$table[1][2] = '6 value';
		$table[2][0] = '8 value';
		$table[2][1] = '9 value';
		$table[2][2] = '10 value';
			
			
        $table1 =  HtmlHelper::tableCreate(array('bordered'=>true,'align'=>'left'),$table);
        $table2 =  HtmlHelper::tableCreate(array('bordered'=>false,'align'=>'center'),$table);
        
        $this->model->addToArray('%radio1%', $radioBtn1);
        $this->model->addToArray('%radio2%',$radioBtn2);
        $this->model->addToArray('%radio3%',$radioBtn3);
        
        $this->model->addToArray('%checkbox1%',$checkBox1);
        $this->model->addToArray('%checkbox2%',$checkBox2);
        $this->model->addToArray('%checkbox3%',$checkBox3);
        
        $this->model->addToArray('%list1%',$list1);
        $this->model->addToArray('%list2%',$list2);
        $this->model->addToArray('%description1%',$description1);
        $this->model->addToArray('%description2%',$description2);
        $this->model->addToArray('%select1%',$select1);
        $this->model->addToArray('%select2%',$select2);
        $this->model->addToArray('%table1%',$table1);
        $this->model->addToArray('%table2%',$table2);

        $this->pageDefault();   
        $this->view->templateRender();          
    }   

    private function pageDefault()
    {   
        $mArray = $this->model->getArrayDefault();     
        $this->view->addToReplace($mArray);            
    }              
}

