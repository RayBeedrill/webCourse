//const myPath = 'http://bookerexam.loc/server/'
const myPath = 'http://192.168.0.15/~user4/booker/server/'

//const shopHome = 'http://bookerexam.loc/#/'
//const shopHome = 'http://rreznichenko-wsos.devhostopia.com/#/'
//const shopHome = 'http://localhost:8080/#/'
const shopHome = 'http://192.168.0.15/~user4/booker/client/#/'

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function dataToParamString(data){
	var string= '';
	for(let val in data){
		string += val + '=' + encodeURIComponent(data[val]) + '&' 
	}
	return string;
}

function getQuery(obj, address, data = false){
	if(data){
		var query = address + data 	
	}else{
		var query = address 
	}

	return obj.$http.get(query).then(response => {
	  return response.body
	}, response => {
		return false
	});
}

function postQuery(obj, address, data){
	let dataForm = new FormData()
	for(let obj in data){
		dataForm.append(obj,data[obj])
	}

	return obj.$http.post(address,dataForm).then(response => {
	  return response.body
	}, response => {
		return false
	});
}

function putQuery(obj, address, data){
	let str = dataToParamString(data)
	
	return obj.$http.put(address,str).then(response => {
	  	return response.body
	}, response => {
		return false
	});

}

function deleteQuery(obj, address, data = false){
	if(data){
		var query = address + data 	
	}else{
		var query = address 
	}
	

	return obj.$http.delete(query).then(response => {
	  return response.body
	}, response => {
		return false
	});
}





      
