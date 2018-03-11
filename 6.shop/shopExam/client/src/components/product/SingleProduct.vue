<template>
<v-container  grid-list-md text-xs-center >
    <v-layout  row wrap>
      <v-flex xs6 offset-xs3>
        <p>title:{{book.title}}</p>
        <p>authors:{{book.authors}}</p>
        <p>genres:{{book.genres}}</p>
        <p>desc:{{book.description}}</p>
        <p>price:{{countPrice + currency}}</p>
        <p>discount:{{book.amount}}</p>
        <p v-if="login">Count:{{count}}</p>
    </v-flex>
     <v-flex v-if="login && notInCart" xs6 offset-xs3>
            <v-slider
              color="orange"
              label="Count"
              hint="Choose count of products"
              min="1"
              max="25"
              thumb-label
              v-model="count"
              
            ></v-slider>
            <v-btn v-on:click="addToCard" color="primary green">Buy</v-btn>
          </v-flex>
          <v-flex v-else xs6 offset-xs3>
              <p v-if="login">already in cart</p>
          </v-flex>
  </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'SingleProduct',
  data () {
    return {
      msg: 'singleProduct',
      book:'',
      count:1,
      login:false,
      admin:false,
      items:[],
      id:'',
      notInCart:true,
      currency:currency
      
      
  }
},
  created: function(){

    this.login = this.$route.meta.login
    this.admin = this.$route.meta.admin
    
    this.getBookById()
    
    if(this.login)
    {
      this.id = getCookie("id")  
      this.getCart()
    }
  },
  methods:{
    getCart(){
        this.$http.get(myPath + 'application/api/cart/' + this.id).then(response => {

        // get body data
          var data = response.body
          
          for(let obj in data){

            if(data[obj].id_book == this.$route.params.id){
              this.notInCart = false
            }
          }       
          
          
          
                    

        }, response => {
        
        });
      },
    getBookById(){
      // GET /someUrl
     let id = this.$route.params.id

    //let link = 'http://192.168.0.15/~user4/shop/serv/application/api/books/' + id
    let link = myPath + 'application/api/books/' + id
    this.$http.get(link).then(response => {

    // get body data
   let bookArr = response.body
   this.book = bookArr[0]
   
    }, response => {
    console.log(response)
  }); 
    },
    addToCard(){
      let id = getCookie("id")
      let data = new FormData()
      data.append('id_user', id)
      data.append('id_book', this.book.id_book)
      data.append('count', this.count)
      

      let link = myPath + 'application/api/cart/'
      this.$http.post(link,data).then(response => {
           
         window.location.href = shopHome + '#/profile/cart'

      }, response => {
      console.log(response)
  });

    }
  },
  computed:{
    countPrice(){
      return (this.book.price - this.book.amount) * this.count
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
