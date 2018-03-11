<?php 
/**
 *  core class of controller can create model and view obj
 *  he gets requests from frontend and send its to model or not;
 *  when model returns data controller sends on view, than view 
 *  shows temolate and data in view for user
 */
namespace application\core;
	class Controller
	{
		protected $model;
		protected $view;
		
		/**
		 * @param  string
		 * @return array
		 *
		 * returns array of input data from queryString
		 */
		public function parseGetData($input)
		{
			$pattern = ['/\.txt/','/\.html/','/\.xml/','/\.json/'];
			$input = preg_replace($pattern,'',$input);
			$data = explode('/',$input);
			return $data;
		}

		/**
		 * @return array
		 *
		 * return data came from post query
		 */
		public function getPostData()
		{
			return $_POST;
		}

		/**
		 * @return array
		 *
		 * Returns array of put data recived from a client
		 */
		public function getPutData()
		{
			$arr = array();
            $putdata = file_get_contents('php://input'); 
            $exploded = explode('&', $putdata);  
            
          foreach($exploded as $pair) { 
            $item = explode('=', $pair); 
            if(count($item) == 2) { 
              $arr[urldecode($item[0])] = urldecode($item[1]); 
            } 
          }
          
         return  $arr;
		}

		/**
		 * @param  string
		 * @return array
		 *
		 * Returns data from queryString for delete query
		 */
		public function getDeleteParams($input)
		{
			$data = explode('/',$input);
			return $data;
		}
	}
