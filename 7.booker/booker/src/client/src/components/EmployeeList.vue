<template>
  <div class="list">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <table class="table">
            <thead>
              <tr>
                <td>name</td>
                <td>action</td>
                <td>action</td>
              </tr>

            </thead>
            <tbody>
              <tr v-for="user in userListUpdate">
                <td>{{user.id_user}}</td>
                <td><a :href="'mailto:' + user.email">{{user.name}}</a></td>
                <td class="remove-action" v-if="userId != user.id_user" v-on:click="removeUser(user.id_user)">REMOVE</td>
                <td class="remove-action" v-if="userId == user.id_user" ></td>
                <td><router-link :to="'/employeeEdit/' + user.id_user">EDIT</router-link></td>
              </tr>
            </tbody>
          </table>
          <router-link class="btn btn-primary" :to="'/employeeEdit'">add a new employee</router-link>
        </div>
      </div>
    </div>
       
  </div>
</template>

<script>
export default {
  name: 'employeeList',
  data () {
    return {
     usersArr:[],
     rowClass:'',
     userId:getCookie("id"),
    }
  },
  created(){
    this.checkAdmin()
    this.getUsers()
  },
  methods:{
    removeUser(id){
      let succ = (result) => {
        this.rowClass = 'acount-fade'
        this.getUsers()
      }

      if(confirm("Confirm delete please")){
        deleteQuery(this,myPath + 'application/api/users/',id).then(succ,null) 
      }
      
    },
    getUsers(){
      let succ = (result) => {
        this.usersArr = result
      }

      getQuery(this,myPath + 'application/api/users/').then(succ,null)
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
  },
  computed:{
    userListUpdate(){
      return this.usersArr;
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
.remove-action{
  color: #23527c;
}
  .remove-action:hover{
    cursor: pointer;
    text-decoration: underline;
  }
</style>
