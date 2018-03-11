<template>
  <div class="auth">
    <div class="container">
      <div class="row title">
        <h1>{{msg}}</h1>
        <h5 class="text-danger" v-if="err">{{err}}</h5>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-div">
            <input v-on:keyup.enter="loginMeth" v-model="login" class="form-control" placeholder="Login" type="text" name="login">
            <input v-on:keyup.enter="loginMeth" v-model="pass" class="form-control" placeholder="Password" type="password" name="pass">
            <button v-on:click="loginMeth" class="btn btn-success login-btn" type="submit">Login</button>
          </div>
        </div>    
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'auth',
  data () {
    return {
      msg: 'Please enter login and pass',
      login: '',
      pass: '',
      err:'',
    }
  },
  created(){
    let id = getCookie("id")

    if(id){
      this.$router.push('/calendar')
    }                          
  },
  methods: {
    loginMeth() {
      let data = {
            login: this.login,
            pass: this.pass    
          }

      let loginSucc = (result) =>{
        if(result == true){
          this.$router.push('/calendar')
        }else{
          
          this.err = 'wrong password or login'
        }
      }

      let loginFail = (result) =>{
        this.err = "some connection issues"
      }

      putQuery(this,myPath + 'application/api/auth/',data).then(loginSucc,loginFail)
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

.title{
  text-align: center;
  margin-top: 15px;
}
.login-div{
  height: 180px;
  width: 100%;
  margin-top: 75px;
  padding: 15px 15px 0 15px;
  border-radius: 4px;
  -webkit-box-shadow: 0px 2px 13px 5px #B0B0B0;
  box-shadow: 0px 2px 13px 5px #B0B0B0;
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
