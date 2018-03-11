
new Vue({
  el: '#mainBlock',
  data: {
    carInfo:{},
    id:'',
    brand:'',
    model:'',
    srcImg:'',
    color:'',
    maxSpeed:'',
    price:'',
    year:'',
  },
  created: function(){
  		var ajax = new AutoGeekRequest;
      var id = this.getUrlVal();
  		var carInfo = ajax.getCarInfo(id,'../AutoGeekMethods.php');

  		this.setProduct(carInfo);
      this.id = this.carInfo.id;
      this.brand = this.carInfo.brand;
      this.color = this.carInfo.color;
      this.maxSpeed = this.carInfo.max_speed;
      this.model = this.carInfo.model;
      this.price = this.carInfo.price;
      this.srcImg = this.carInfo.src;
      this.year = this.carInfo.year;
  },
  methods:{
  	setProduct: function(arr){
  		for(obj in arr){
  			for(val in arr[obj]){
  				if(val == "id"){
  					arr[obj].src = "../images/products/" + arr[obj][val] + ".jpg";
  				}
  			}
  			this.carInfo = arr[obj];
  		}
  	},
    getUrlVal : function(){
      var urlString = window.location.search;
      var valueString = urlString.split('?')[1];
      var id = valueString.split('=')[1];
      return id;
    },
    writeCarData: function(){
      var car = this.carInfo;
      localStorage['data'] = JSON.stringify(car.id);
      window.location = window.origin + "/~user4/SOAP/task2/client/pages/BuyCar.html";
//      window.location = window.origin + "/client/pages/BuyCar.html";
    }
  }
});

