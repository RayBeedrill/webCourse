Vue.component("product",{
  template: '<a v-bind:href="countParams.link"><div class="product-exp"><img v-bind:src="countParams.srcImg"><p> {{countParams.brand}} {{countParams.model}}</p></div></a>',
  data: function(){
    return {
      id:'',
      brand:'',
      model:'',
      link:'',
      srcImg:'',

    }
  },
  created:function(){
    this.id = this.params.id;
    this.brand = this.params.brand;
    this.model = this.params.model;
    this.srcImg = this.params.src;
    this.link = "pages/CarInfo.html?id=" + this.id;
  },
  computed:{
    countParams:function(){
      var data ={
      id : this.params.id,
      brand : this.params.brand,
      model : this.params.model,
      srcImg : this.params.src,
      link : "pages/CarInfo.html?id=" + this.params.id,
      }
      return data
    }
  },
  props:['params']
});

Vue.component("MyFilter",{
	template: '<select class="form-control" name="" v-model="id"><option value="false">Choose {{nameSelect}}</option><option :value="obj.id" v-for="obj in optionsfilter">{{ obj[field] }}</option></select>',
	data: function(){
		return {
			id:"false",
      field:'',
      nameSelect:''
    }
	},
	created:function(){
    for(val in this.optionsfilter[0]){
        this.field = val;      
    }
    if(this.field == 'max_speed' ){
      this.nameSelect = 'max speed';
    }else{
      this.nameSelect = this.field
    }
	},
  watch:{
    id: function(newId){
      var data = {
        field: this.field,
        id: newId
      }
      
      if(data.field == "max_speed"){
        
        for(obj in this.optionsfilter){
          for(val in this.optionsfilter[obj]){
            if(this.optionsfilter[obj].id == data.id){
              data.id = this.optionsfilter[obj].max_speed;
            }
          }
        }
      }

      if(data.field == "model"){
        for(obj in this.optionsfilter){
          for(val in this.optionsfilter[obj]){

            if(this.optionsfilter[obj].id == data.id){

              data.id = this.optionsfilter[obj].model;

            }
          }
        }
      }
      this.$emit('getfilters',data);
    }
  },
	props:['optionsfilter']

});

new Vue({
  el: '#mainBlock',
  data: {
    carList:[],
    filters:[],
    year:"false",
    color:"false",
    capacity:"false",
    model:"false",
    maxspeed:"false",
    brand:"false",
    filterMsg:''
  },
  created: function(){
  		
  		
  },
  methods:{
  	setList: function(arr){
      if(this.carList.length > 0){
        this.carList = [];
      }
  		for(obj in arr){
  			for(val in arr[obj]){
  				if(val == "id"){
  					arr[obj].src = "images/products/" + arr[obj][val] + ".jpg";
  				}
  			}
  			this.carList.push(arr[obj]);
  		}
  	},
    getfilters:function(data){
      if(data.field == 'year'){
        this.year = data.id;
      }

      if(data.field == 'color'){
        this.color = data.id;
      }

      if(data.field == 'capacity'){
        this.capacity = data.id;
      }

      if(data.field == 'model'){
        this.model = data.id;
      }

      if(data.field == 'max_speed'){
        this.maxspeed = data.id;
      }

      if(data.field == 'brand'){
        this.brand = data.id;
      }
      
    },
    filterSettings(){
      
        var ajax = new AutoGeekRequest;
        var data = {
          "year":this.year,
          "color":this.color,
          "capacity":this.capacity,
          "maxSpeed":this.maxspeed,
          "model":this.model,
          "brand":this.brand,
        }
        if(this.year == "false" && this.color == "false" && this.capacity == "false" && this.maxspeed == "false" && this.model == "false" && this.brand == "false"){
          var carList = ajax.getCarList('AutoGeekMethods.php');
          this.setList(carList);
          var filtersList = ajax.getAllFilters('AutoGeekMethods.php');
          if(this.filters.length > 0){
            this.filters = [];
          }
          for(val in filtersList){
            this.filters.push(filtersList[val]);
          }
        }else{
          if(this.year != "false"){
          var newArr = ajax.getCarBySettings(data,'AutoGeekMethods.php');
          this.setList(newArr);
          this.filterMsg = "";
          }else{
            this.filterMsg = "Please select year";  
          }
          
        }
        return this.carList;
    }
  },
  computed:{
    filterProducts(){
      var newArr = this.filterSettings();    
      
      return newArr;
    }
  }
});

