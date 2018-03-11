<?php
function uploadFile(){
    $uploadFile = UP_PATH . basename($_FILES['userfile']['name']);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if($uploadFile !== UP_PATH ){
			if(file_exists(UP_PATH)){
				if(!file_exists($uploadFile)){
					if( move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadFile)){
						return UP_SUC;
					}else{
						return UP_ERR;
					}	
				}else{
					return UP_WARN_EX;
				}
			}else{
				return PATH_ERR;	
			}	
		}else{
			return UP_WARN;
		}
	}
}

function sizeValueShow($size){
	if($size > KB && $size <= MB){
		$size *= 0.001;
		$size = substr($size, 0 , 5);
		$size .= 'Kb';
		return $size;
	}elseif($size > MB){
		$size *= 0.000001;
		$size = substr($size, 0 , 5);
		$size .= 'Mb';
		return $size;
	}
	return $size . 'b';
}

function showDir(){   
	if(file_exists(UP_PATH)){
    	$namesArr = scandir(UP_PATH);

		unset($namesArr[0], $namesArr[1]);
		$namesArr = array_values($namesArr);
    	$sizesArr = array();

    	foreach($namesArr as $key => $value){
        	$fileSize = filesize(UP_PATH . $namesArr[$key]);
			$fileSize = sizeValueShow($fileSize);
        	array_push($sizesArr,$fileSize);
    	}

    	$data = array($namesArr, $sizesArr);  
    	return $data;   
	}else{
		return $data = PATH_ERR;
	}
}   
   
function deleteFile(){
$deleteFile = $_GET['deleteFile'];
	if(!is_null($deleteFile)){
		if(file_exists(UP_PATH . $deleteFile)){
			if(unlink(UP_PATH . $deleteFile)){
				return DEL_SUC;
			}else{
				return DEL_ERR;
			}
		}else{
			return DEL_ERR;
		}
	}
}



