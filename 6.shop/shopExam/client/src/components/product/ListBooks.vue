<template>
   <v-container  grid-list-md text-xs-center >
  <h4>{{ msg }}</h4>
    <v-layout  row wrap>
      <v-flex xs12>
              <v-data-table
      v-bind:headers="headers"
      :items="allBooksArr"
      hide-actions
      class="elevation-1"
    >
    <template slot="items" scope="props">
      
      <td>{{props.item.id_book }}</td>
      <td class="text-xs-right">{{ props.item.title }}</td>
      <td class="text-xs-right">{{ props.item.authors }}</td>
      <td class="text-xs-right">{{ props.item.genres }}</td>
      <td class="text-xs-right">{{ props.item.price + currency }}</td>
      <td class="text-xs-rigth"><router-link :to="'editBook/' + props.item.id_book">{{ props.item.edit }}</router-link></td>
      
    </template>
  </v-data-table>
     </v-flex>
    </v-layout>
</v-container>
</template>

<script>
export default {
  name: 'AllBooks',
  data () {
    return {
      msg: 'All books',
      pagination: {
          sortBy: 'title'
        },
        selected: [],
        headers: [
          {
            text: 'id',
            align: 'left',
            value: 'id_book'
          },
          { text: 'title', value: 'title' },
          { text: 'authors', value: 'author' },
          { text: 'genres', value: 'genre' },
          { text: 'price', value: 'price' },
          { text: '', value: 'edit',align:'center' },
        ],
        allBooksArr:[],
        currency:currency
      }
    },
    methods:{
      getAllBooks(){

      // GET /someUrl
      //this.$http.get('http://192.168.0.15/~user4/shop/serv/application/api/books/').then(response => {
      this.$http.get(myPath + 'application/api/books/').then(response => {

      // get body data
      let data = response.body
      for(let val in data){
        data[val].edit = 'edit'
        this.allBooksArr.push(data[val])
      }

      }, response => {
      
      });

      },
    },
    created:function(){
      this.getAllBooks()

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
</style>
