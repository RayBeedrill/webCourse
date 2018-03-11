<template>
  <v-container  grid-list-md text-xs-center >
      <h5>{{ email }}</h5>
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
      <v-flex xs4 offset-xs4>
         <v-btn v-on:click="editUser" color="primary">Edit</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'UserInfo',
  created: function(){
      this.id = getCookie("id")
      this.getUserInfo()
  },
  data () {
    return {
      name:'',
      secondName:'',
      phone:'',
      email:'',
      msg: '',
      info:[],
      err:'',
      id:''
    }
  },
  methods:{
    editUser(){
      if(this.name.length > 0  && this.phone.length > 0 && this.secondName.length > 0){
          let data = {
            'id': this.id,
            'name': this.name,
            'secondName': this.secondName,
            'phone': this.phone
          }
          
          let str = this.dataToParamString(data)
          
          this.$http.put(myPath + 'application/api/profile/',str).then(response => {
          this.err = 'succsess'
            console.log(response.body)
          }, response => {
                  this.err = response.statusText
          });  
        }else{
          this.err = ''          
          if(this.name.length == 0){
            this.err += ' Enter name, '
          }

          if(this.phone.length == 0){
            this.err += ' Enter phone, '
          }

          if(this.secondName.length == 0){
            this.err += ' Enter secondName '
          }
        }
    },
     dataToParamString : function(data){
      var string= '';
      for(let val in data){
        string += val + '=' + encodeURIComponent(data[val]) + '&' 
      }
       return string;
    },
    getUserInfo(){
        //let id = 
        
        this.$http.get(myPath + 'application/api/users/' + this.id).then(response => {

        // get body data
          var data = response.body
          this.name = response.body[0].name
          this.secondName = response.body[0].secondName
          this.phone = response.body[0].phone
          
          
                    

        }, response => {
        
        });
          
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
