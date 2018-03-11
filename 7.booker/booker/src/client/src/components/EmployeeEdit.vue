<template>
  <div class="add user">
    <div class="container">
      <div class="row title">
        <h1>{{msg}}</h1>
        <h5 class="text-danger" v-if="err">{{err}}</h5>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-div" :class="id ? 'edit-div' : ''">
            <input  v-model="name" class="form-control" placeholder="Name" type="text" name="Name">
            <input  v-model="email" class="form-control" placeholder="Email" type="email" name="email">
            <input  v-if="id == ''" v-model="login" class="form-control" placeholder="Login" type="text" name="login">
            <input  v-if="id == ''" v-model="pass" class="form-control" placeholder="Password" type="password" name="pass">
            <button v-if="id == ''" v-on:click="registerUser" class="btn btn-success login-btn" type="submit">Register</button>
            <button v-if="id" v-on:click="editUser" class="btn btn-success login-btn" type="submit">Edit</button>
          </div>
        </div>    
      </div>
    </div>
    </div>
       
  </div>
</template>

<script>
export default {
  name: 'employeeEdit',
  data () {
    return {
     msg:'',
     login:'',
     pass:'',
     name:'',
     email:'',
     err:'',
     id:''
    }
  },
  created(){
    this.checkAdmin()
    if(this.$route.params.id == undefined){
      this.msg = 'Add new user'
    }else{
      this.msg = 'Edit user'
      this.id = this.$route.params.id
      
      this.getUser()
    }
  },
  methods:{
    getUser(){
      let id = this.id

      let succ = (result) => {
        let person = result[0]
        this.name = person.name
        this.email = person.email
        this.login = person.login
      }


      getQuery(this,myPath + 'application/api/users/',id).then(succ,null)

    },
    editUser(){
      if(this.name.length > 3 && this.email.length > 3){
        let data = {
          id: this.id,
          name: this.name,
          email: this.email
        }

        let succ = (result) => {
          
          if(result == true){
            this.err = "user edited"           
          }

          if(typeof result == 'object'){
            this.err = ''
            if(!result.name){
              this.err += '| name must be only character |' 
            }

            if(!result.email){
              this.err += ' | email has no valid format| ' 
            }
          }          
          
        }

        putQuery(this,myPath + 'application/api/users/',data).then(succ,null)
      }else{
        this.err = 'inputs has errors'
      }
    },
    registerUser(){
      if(this.login.length > 3 && this.pass.length > 4 && this.name.length > 3 && this.email.length > 3){
        let data = {
          name: this.name,
          login: this.login,
          pass: this.pass,
          email: this.email
        }

        let succ = (result) => {
          if(result == true){
            this.login = ''
            this.pass = ''
            this.name =''
            this.email = ''
            this.err = 'user registred success'
          }

          if(result == false){
            this.err = 'this login already in use'
          }

          if(typeof result == 'object'){
            this.err = ''
            if(!result.name){
              this.err += '| name must be only character |' 
            }

            if(!result.login){
              this.err += ' | login can contain only charaters and nums | '
            }

            if(!result.pass){
              this.err += ' | password must contain atleast one num and one big character | '
            }

            if(!result.email){
              this.err += ' | email has no valid format| ' 
            }
          }

        }


        postQuery(this,myPath + 'application/api/auth/',data).then(succ,null)
      }else{
        this.err = 'inputs has errors'
      }
    },
    checkAdmin(){
      let adminCheck = (result) => {        
        if(result.id_role == "1"){
          return true
        }else{
          this.$router.push('/calendar')
        }
      }

      let fail = () => {
        this.$router.push('/')
      }

    getQuery(this,myPath + 'application/api/auth/').then(adminCheck,fail)
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

.title{
  text-align: center;
  margin-top: 15px;
}
.login-div{
  height: 280px;
  width: 100%;
  margin-top: 75px;
  padding: 15px 15px 0 15px;
  border-radius: 4px;
  -webkit-box-shadow: 0px 2px 13px 5px #B0B0B0;
  box-shadow: 0px 2px 13px 5px #B0B0B0;
}

.edit-div{
  height: 180px;
}
.login-div form{
  text-align: center;
}

.login-div input{
  margin-top: 15px;
} 

.login-div button{
  margin-top: 15px;
}
</style>
