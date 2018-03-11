<template>
  <v-container  grid-list-md text-xs-center >
    <h4>{{ msg }}</h4>
    <h6>{{ err }}</h6>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Name"
      v-model="name"
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Second Name"
      v-model="secondName"
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Phone"
      v-model="phone"
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Email"
      v-model="email"
      required
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Login"
      v-model="login"
      required
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Password"
      v-model="pass"
      required
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
         <v-text-field
      label="Password confirm"
      v-model="passConfirm"
      required
       ></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout  row wrap>
      <v-flex xs4  offset-xs4>
        <v-select
              label="Select Discount"
              v-bind:items="discountArr"
              item-value="id_discount"
              item-text="amount"
              v-model="discount"
              max-height="400"
            ></v-select>
      </v-flex>
      <v-flex xs4 offset-xs4>
         <v-btn v-on:click="register" color="primary">Register</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'AddUser',
  data () {
    return {
      msg: 'addUser',
      name:'',
      secondName:'',
      phone:'',
      login:'',
      email:'',
      pass:'',
      passConfirm:'',
      err:'',
      discount:'',
      discountArr:[]

    }
  },
  created:function(){
    this.getDiscount()
  },
  methods:{
    getDiscount(){
        let self = this
        //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/discount/').then(response => {
        this.$http.get(myPath + 'application/api/discount/').then(response => {

        // get body data
          let discount = response.body
          
          for(let obj in discount){
              self.discountArr.push(discount[obj])
          }
        }, response => {
        
        });

      },
    register(){
      if(this.pass == this.passConfirm){

        if(this.login.length > 0 && this.email.length > 0 && this.pass.length > 0){
          let data = new FormData()
          data.append('name', this.name)
          data.append('secondName', this.secondName)
          data.append('login', this.login)
          data.append('password', this.pass)
          data.append('phone', this.phone)
          data.append('email', this.email)
          if(this.discount.length > 0){
            data.append('discount', this.discount)  
          }else{
            data.append('discount', "1")  
          }
          
          // this.$http.post('http://192.168.0.15/~user4/shop/serv/application/api/users/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
          this.$http.post(myPath + 'application/api/users/',data ,{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).then(response => {
          this.err = 'succsess'
          this.name = ''
          this.secondName = ''
          this.login = ''
          this.pass = ''
          this.phone = ''
          this.email = ''
          this.passConfirm = ''
          this.discount = ''
          }, response => {
                  this.err = response.statusText
          });  
        }else{
          
          if(this.login.length == 0){
            this.err += ' Enter login, '
          }

          if(this.email.length == 0){
            this.err += ' Enter email, '
          }

          if(this.pass.length == 0){
            this.err += ' Enter password '
          }
        }
      }else{
        this.err += 'pass confirm is wrong, '
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
