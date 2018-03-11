<template>
 <v-container  grid-list-md text-xs-center >
  <h4>{{ msg }}</h4>
  <h5>Total Price: {{totalPriceCount}}</h5>
    <v-layout  row wrap>
      <v-flex xs12>
            <v-data-table
          v-model="selected"
          v-bind:headers="headers"
          v-bind:items="items"
          select-all
          v-bind:pagination.sync="pagination"
          item-key="id_cart"
          class="elevation-1"
        >
        <template slot="headers" scope="props">
          <tr>
            <th>
              <v-checkbox
                primary
                hide-details
                @click.native="toggleAll"
                :input-value="props.all"
                :indeterminate="props.indeterminate"
              ></v-checkbox>
            </th>
            <th v-for="header in props.headers" :key="header.text"
              :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
              @click="changeSort(header.value)"
            >
              <v-icon>arrow_upward</v-icon>
              {{ header.text }}
            </th>
          </tr>
        </template>
        <template slot="items" scope="props">
          <tr :active="props.selected" @click="props.selected = !props.selected">
            <td>
              <v-checkbox
                primary
                hide-details
                :input-value="props.selected"
              ></v-checkbox>
            </td>
            <td>{{ props.item.id_book }}</td>
            <td class="text-xs-center">{{ props.item.title }}</td>
            <td class="text-xs-center">{{ props.item.count }}</td>
            <td class="text-xs-center">{{ props.item.amount }}</td>
            <td class="text-xs-center">{{ props.item.price }}</td>
          </tr>
        </template>
      </v-data-table>
     </v-flex>
    </v-layout>
    <v-layout v-if="items.length > 0" row wrap>
        <v-flex text-xs-right xs4 offset-xs8>
           <v-btn v-on:click="deleteSelectedItems" color="primary red">Delete</v-btn>
           <router-link style="margin: 0 auto" to="/checkout"><v-btn v-on:click="localStorageWrite" color="primary green">Checkout</v-btn></router-link>
        </v-flex>
    </v-layout>
</v-container>
</template>

<script>
export default {
  name: 'UserCart',
   data () {
      return {
        msg:"Cart",
        pagination: {
          sortBy: 'id_book'
        },
        selected: [],
        headers: [
          {
            text: 'id book',
            align: 'left',
            value: 'id_book'
          },
          { text: 'title', value: 'title', align:"center" },
          { text: 'count', value: 'count', align:"center" },
          { text: 'discount', value: 'amount', align:"center" },
          { text: 'price', value: 'price' , align:"center"},
          
        ],
        items: [],
        id:'',
        totalPrice:0,
      }
    },
    created(){
      this.id = getCookie("id")
      this.getCart()
    },
    computed:{
      totalPriceCount(){
        this.totalPrice = 0
        for(let obj in this.items){
          this.totalPrice += (this.items[obj].price - this.items[obj].amount) * this.items[obj].count
          
        }
        return this.totalPrice
      }
    },
    methods: {
      getCart(){
        this.$http.get(myPath + 'application/api/cart/' + this.id).then(response => {

        // get body data
          var data = response.body
          console.log(data)
          for(let obj in data){
            this.items.push(data[obj])
          }
          
          
                    

        }, response => {
        
        });
      },
      toggleAll () {
        if (this.selected.length) this.selected = []
        else this.selected = this.items.slice()
      },
      changeSort (column) {
        if (this.pagination.sortBy === column) {
          this.pagination.descending = !this.pagination.descending
        } else {
          this.pagination.sortBy = column
          this.pagination.descending = false
        }
      },
      deleteOneItem(id_cart){
        this.$http.delete(myPath + 'application/api/cart/' + id_cart).then(response => {
        }, response => {
        
        });
      },
      deleteSelectedItems(){
        for(let obj in this.selected){
          this.deleteOneItem(this.selected[obj].id_cart)
          for(let item in this.items){
            if(this.selected[obj].id_cart == this.items[item].id_cart){
              this.items.splice(item,1)
            }
          }
        }
        this.localStorageWrite()
      },
      localStorageWrite(){
        let data = {
          id_user:this.id,
          books:this.items,
        }
        let str = JSON.stringify(data)
        window.localStorage['cart'] = str
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
