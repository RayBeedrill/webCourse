<template>
<v-container  grid-list-md text-xs-center >
  <h3>{{msg}}</h3>
  <h4>{{err}}</h4>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Login"
      v-model="login"
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Password"
      v-model="pass"
       ></v-text-field>
      </v-flex>
      <v-flex xs4 offset-xs4>
         <v-btn v-on:click="loginMeth" color="primary">Sign in</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'SignIn',
  data () {
    return {
      msg: 'Sign In',
      login:'',
      pass:'',
      err:''
    }
  },
  methods:{
    loginMeth(){
      let self = this
      if(this.login.length > 0 && this.pass.length > 0){
        let data = {
          login: this.login,
          pass: this.pass    
        }
        let str = this.dataToParamString(data)
        this.$http.put(myPath + 'application/api/auth/',str).then(response => {
          
          if(response.body == 'true'){
            window.location.reload()
            window.location.href = shopHome   
          }else{
            this.err = "wrong login or password"
          }
          
      
        }, response => {
        
        });

      }else{
        this.err = "some inputs are wrong"
      }
      
    },
    dataToParamString : function(data){
      var string= '';
      for(let val in data){
        string += val + '=' + encodeURIComponent(data[val]) + '&' 
      }
       return string;
    },
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
