Vue.component("radio-btn",{
  template: '<div><input type="radio" v-on:click="idchange" name="method" :value="idMethod" v-model="idMethod"><label>{{label}}</label></div>',
  data: function(){
    return {
      idMethod: '',
      label:'',
    }
  },
  created:function(){
    for(val in this.params){
      this.label = this.params[val];
      this.idMethod = this.params.id;
    }
    
  },
  methods:{
    idchange:function(){
      this.$emit("idchange",this.idMethod);
    }
  },
  props:['params']
});

new Vue({
  el: '#mainBlock',
  data: {
    ajax: new AutoGeekRequest,
    name:'',
    secName:'',
    idCar: JSON.parse(localStorage['data']),
    idMethod:"1",
    methods:[],
    msg:'',
    link: false,
    linkHref:'',
    linkText:'Buy',
    classMsg:'',
  },
  created: function(){
  		var payMethods = this.ajax.getAllPaymentMethods('../AutoGeekMethods.php');
      for(payObj in payMethods){
        this.methods.push(payMethods[payObj]);
      }
  },
  methods:{
    writeBuyCar: function(){
        if(this.name.length > 3 && this.secName.length > 3 && localStorage['data'] != ''){
            if(!this.link){
            var data = {
                'name': this.name,
                'secName': this.secName,
                'id_car': this.idCar,
                'id_method': this.idMethod
                };

             this.ajax.buyCar(data,'../AutoGeekMethods.php');
             this.name = '';
             this.secName = '';
             this.idCar = '';
                localStorage['data'] = '';
            }
            this.msg = 'buy succes';
            this.classMsg = "link-succ";
            this.linkHref = "http://192.168.0.15/~user4/SOAP/task2/client/";
            this.linkText = "Go home";
            this.link = true;
                    
        }else{
            this.msg = 'Some fields are required';
        }
    },
    idchange: function(data){
      this.idMethod = data;
    }	
  }
});

