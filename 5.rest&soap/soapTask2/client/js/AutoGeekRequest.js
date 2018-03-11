 var AutoGeekRequest = function(){

 	this.getHttpRequestObj = function(){

 		var xmlhttp;
	    
	    try {
	        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	    } catch (e) {
	        try {
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        } catch (E) {
	            xmlhttp = false;
	        }
	    }
	    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	        xmlhttp = new XMLHttpRequest();
	    }

	    return xmlhttp;
 	}
 	
 	this.ajaxRequest = function(name, value,path){

		var xhr = this.getHttpRequestObj();
		var data = name + "=" + value;

		xhr.open('POST', path , false);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(data);

		if (xhr.status != 200) {
		  console.log( xhr.status + ': ' + xhr.statusText ); 
		} else {
		  return ( xhr.responseText ); 
		}
 	}
 	
 	this.getCarList = function(path){
     	var data = this.ajaxRequest("getCarList", "true",path);
     	data = JSON.parse(data);
     	return data;
    }
    
    this.getCarInfo = function(id,path){
    	var data = this.ajaxRequest("getCarInfo", id, path);
     	data = JSON.parse(data);
     	return data;	
    }    
    
    this.getCarBySettings = function(arr,path){
    	arr = JSON.stringify(arr);
    	var data = this.ajaxRequest("getCarBySettings", arr, path);
     	data = JSON.parse(data);
     	return data;
    }

    this.getAllFilters = function(path){
    	var data = this.ajaxRequest("getAllFilters", "true", path);
     	data = JSON.parse(data);
     	return data;	
    }

    this.getAllPaymentMethods = function(path){
    	var data = this.ajaxRequest("getAllPaymentMethods", "true", path);
     	data = JSON.parse(data);
     	return data;	
    }

    this.buyCar = function(arr,path){
    	arr = JSON.stringify(arr);
    	var data = this.ajaxRequest("buyCar", arr, path);
    }
 }
