<template>
  <v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>.
    <h5>{{ err }}</h5>
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        style="display: inline-flex;width: 50%;"
        label="Edit Discount Value"
        v-model="discount"
      ></v-text-field>
       <v-btn v-on:click="updateDiscount" color="primary blue">Edit</v-btn>
       
    </v-flex>
    <v-flex offset-xs4 xs4>
      <v-select
              label="Select"
              v-bind:items="itemsDis"
              item-text="amount"
              item-value="id_discount"
              v-model="discount"
              max-height="400"
              hint="Pick discount"
              persistent-hint
            ></v-select>
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'EditDiscount',
  created: function(){
    this.discountArr = []
    this.getDiscount()
    
  },
  data () {
    return {
      msg: 'editDiscount',
      discount:'',
      id:'',
      list:'Multy select list of discount',
      itemsDis:[],
      err:''
    }
  },
  methods:{
      getDiscount(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/discount/').then(response => {
        this.$http.get(myPath + 'application/api/discount/').then(response => {

        // get body data
          let discount = response.body
          console.log(discount)
          for(let obj in discount){
              self.itemsDis.push(discount[obj].amount) 
              self.discountArr.push(discount[obj])
          }
        console.log(discount)  
        }, response => {
        
        });


      },
      updateDiscount(){
        let self = this
        if(this.id.length > 0 && this.discount.length > 0){
          let data = {
            'id': this.id,
            'value':this.discount
          }
          let str = this.dataToParamString(data)
          
          //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/discount/' + this.id).then(response => {
          this.$http.put(myPath + 'application/api/discount/',str).then(response => {
          this.err = 'succsess'
          
          }, response => {
          
          });
        }else{
          this.err = 'choose discount'
        }
      },
      deleteDiscount(){
        let self = this

        //this.$http.delete('http://192.168.0.15/~user4/shop/serv/application/api/discount/' + this.id).then(response => {
        this.$http.delete(myPath + 'application/api/discount/' + this.id).then(response => {
        this.err = 'succsess'  
        window.location.reload()
        }, response => {
        
        });

      },
      dataToParamString : function(data){
      var string= '';
      for(let val in data){
        string += val + '=' + encodeURIComponent(data[val]) + '&' 
      }
       return string;
    }
  },
  watch:{
    discount(){
        let arr = this.discountArr
        for(let obj in  this.discountArr ){
          if(this.discountArr[obj].amount == this.discount){
              this.id = this.discountArr[obj].id_discount
          }
        }
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
