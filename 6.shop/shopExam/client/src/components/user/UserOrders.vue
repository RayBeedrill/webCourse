<template>
   <v-container  grid-list-md text-xs-center >
  <h4>{{ msg }}</h4>
    <v-layout  row wrap>
      <v-flex xs12>
      <v-data-table
      v-bind:headers="headers"
      :items="orders"
      hide-actions
      class="elevation-1"
      item-key="id_order"
    >
    <template slot="items" scope="props">
      <tr :key="props.item.id_user" @click="props.expanded = !props.expanded">
        <td>{{props.item.id_order }}</td>
        <td class="text-xs-right">{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.secondName }}</td>
        <td class="text-xs-right">{{ props.item.phone }}</td>
        <td class="text-xs-right">{{ props.item.email }}</td>
        <td class="text-xs-right">{{ props.item.payment_method }}</td>
    </tr>
      
    </template>
    <template slot="expand" scope="props">
      <v-card flat>
        <v-card-text>
          <p>id book: {{props.item.id_book}}</p>
          <p>title: {{props.item.title}}</p>
          <p>author: {{props.item.author}}</p>
          <p>quantity: {{props.item.quantity}}</p>
          <p>discount: {{props.item.discount}}</p>
          <p>total price: {{props.item.price * props.item.quantity - props.item.discount}}</p>
          <p>status: {{props.item.status}}</p>
        </v-card-text>
      </v-card>
    </template>
  </v-data-table>
     </v-flex>
    </v-layout>
</v-container>
</template>

<script>
import selectOrders from '@/components/helpers/selectOrders'
export default {
  name: 'UsersOrders',
  data () {
    return {
      msg: 'Users Orders',
      pagination: {
          sortBy: 'name'
        },
        selected: [],
        headers: [
          {
            text: 'order id',
            align: 'center',
            value: 'id_order'
          },
          { text: 'Name', value: 'name' },
          { text: 'Second Name', value: 'secondName' },
          { text: 'Phone', value: 'phone' },
          { text: 'Email', value: 'email' },
          { text: 'Payment method', value: 'payment_method' },
        ],
        orders:[],
        status:[],
        id:''
      }
    },
    components:{
      selectOrders
    },
    methods:{
      getAllOrders(){

      // GET /someUrl
      //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/books/').then(response => {
      this.$http.get(myPath + 'application/api/orders/' + this.id).then(response => {

      // get body data
      let data = response.body
      for(let obj in data){
        this.orders.push(data[obj])
        this.status[data[obj].id_order] = data[obj].status
      }
      
      }, response => {
      
      });

      },
    },
    created:function(){
      this.id = getCookie("id")  
      this.getAllOrders()
      
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
td:hover{
  cursor: pointer;
}
</style>
