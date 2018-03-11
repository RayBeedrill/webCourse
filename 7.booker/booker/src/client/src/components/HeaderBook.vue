<template>
  <div class="header">
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <router-link :to="'/calendar'" class="navbar-brand" href="#">GeekBooker</router-link>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul v-if="login" class="nav navbar-nav">
        <li><router-link :to="'/calendar'">Calendar</router-link></li>
      </ul>
      <ul v-if="login" class="nav navbar-nav navbar-right">
        <li v-if="admin"><router-link :to="'/employeeList'">Admin panel</router-link></li>
        <li><a href="#" v-on:click="logout">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  </div>
</template>

<script>
export default {
  name: 'header',
  data () {
    return {
      login:false,
      admin:false
    }
  },
  created(){
    let id = getCookie("id")

    if(id){

        this.login = true
        this.checkAdmin()
      }
  },
  methods:{
    logout(){
      let succsess = () => {
        this.login = false
        this.admin = false
        this.$router.push('/')  
      }

      deleteQuery(this,myPath + 'application/api/auth/').then(succsess,null)
    },
    checkAdmin(){
      let adminCheck = (result) => {        
        if(result.id_role == "1"){
          this.admin = true
        }else{
          this.admin = false
        }
      }
      getQuery(this,myPath + 'application/api/auth/').then(adminCheck,null)
    }
  },
  watch: {
    '$route' (to, from) {
      this.login = to.meta.login
      this.checkAdmin()
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
