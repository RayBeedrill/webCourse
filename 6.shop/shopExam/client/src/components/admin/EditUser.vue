<template>
   <v-container  grid-list-md text-xs-center >
  <h4>{{ msg }}</h4>
    <v-layout  row wrap>
      <v-flex xs12>
              <v-data-table
      v-bind:headers="headers"
      :items="users"
      hide-actions
      class="elevation-1"
    >
    <template slot="items" scope="props">
      <td>{{props.item.id_user }}</td>
      <td class="text-xs-right">{{ props.item.name }}</td>
      <td class="text-xs-right">{{ props.item.secondName }}</td>
      <td class="text-xs-right">{{ props.item.phone }}</td>
      <td class="text-xs-right">{{ props.item.email }}</td>
      <td class="text-xs-rigth">
      <selectUsers v-on:sendId="getId" :user="props.item.id_user" :valueSel="props.item.status" />
      </td>
      
    </template>
  </v-data-table>
     </v-flex>
    </v-layout>
</v-container>
</template>

<script>
import selectUsers from '@/components/helpers/selectUsers'
export default {
  name: 'EditUsers',
  data () {
    return {
      msg: 'Edit users',
      pagination: {
          sortBy: 'name'
        },
        selected: [],
        headers: [
          {
            text: 'id',
            align: 'center',
            value: 'id_user'
          },
          { text: 'name', value: 'name' },
          { text: 'secondName', value: 'secondName' },
          { text: 'phone', value: 'phone' },
          { text: 'email', value: 'email' },
          { text: 'status', value: 'status',align:'center' },
        ],
        users:[],
        status:[]
      }
    },
    components:{
      selectUsers
    },
    methods:{
      getAllUsers(){

      // GET /someUrl
      //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/books/').then(response => {
      this.$http.get(myPath + 'application/api/users/').then(response => {

      // get body data
      let data = response.body
      for(let obj in data){
        this.users.push(data[obj])
        this.status[data[obj].id_user] = data[obj].status
      }

      }, response => {
      
      });

      },
      updateStatus(data){
        let str = this.dataToParamString(data)
        
        this.$http.put(myPath + 'application/api/users/',str).then(response => {

        }, response => {
        
        });        
      },
      dataToParamString : function(data){
      var string= '';
        for(let val in data){
          string += val + '=' + encodeURIComponent(data[val]) + '&' 
        }
      return string
      },
      createValueArr(id,val){
        this.status[id] = val
      },
      getId(data){
        this.updateStatus(data)
      }
    },
    created:function(){
      this.getAllUsers()

    }
  }
</script>

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
select{
  moz-appearance: initial;
  -webkit-appearance: menulist;
}
</style>
