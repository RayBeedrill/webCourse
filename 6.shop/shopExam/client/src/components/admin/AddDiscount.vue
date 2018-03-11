<template>
  <v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h5>{{ err }}</h5>
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
      <v-text-field
        style="display: inline-flex;width: 50%;"
        label="Discount Value"
        v-model="discount"
      ></v-text-field>
       <v-btn v-on:click="addDiscount" color="primary blue">Add</v-btn>
    </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'AddDiscount',
  data () {
    return {
      msg: 'AddDiscount',
      discount:'',
      err:'',
      list:'list of discount'
    }
  },
  methods:{
    addDiscount(){
      if(this.discount.length > 0)
      {
        let data = new FormData()
        data.append('value', this.discount)
        
        // this.$http.post('http://192.168.0.15/~user4/shop/serv/application/api/discount/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
        this.$http.post(myPath + 'application/api/discount/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
        this.err = 'succsess'
        this.discount = ''
        window.location.reload()
        }, response => {
                this.err = response.statusText
        });
      }else{
        this.err = "please enter discount amount"
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
