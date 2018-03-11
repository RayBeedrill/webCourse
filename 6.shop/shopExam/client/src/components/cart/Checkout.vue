<template>
  <div class="checkout">
    <h3>{{ msg }}</h3>
    <h4>{{ title }}</h4>
    <v-flex xs6 offset-xs4>
            <v-radio-group v-model="methodVal" row>
              <v-radio
                v-for="(method, i) in payment"
                light
                :key="i"
                :value="method.id_payment"
                :label="method.name"
                :color="method.colors[i]"
              ></v-radio>
            </v-radio-group>
          </v-flex>
          <router-link style="margin: 0 auto" to="/"><v-btn v-on:click="buyProducts" color="primary green">Make Order</v-btn></router-link>
  </div>
</template>

<script>
export default {
  name: 'Checkout',
  data () {
    return {
      msg: 'Checkout',
      title: 'choose payment method',
      methodVal: '1',
      colors:['success', 'info', 'error', 'cyan darken-2'],
      payment:[]
    }
  },
  created(){
    this.getPaymentMethods()
    
  },
  methods:{
    getPaymentMethods(){
      this.$http.get(myPath + 'application/api/payment/').then(response => {
        let data = response.body
        for(let obj in data){
          data[obj].colors = []
          for(let color in this.colors){
            data[obj].colors.push(this.colors[color])
          }
          this.payment.push(data[obj])
        } 
            
        }, response => {
          
        });

    },
    buyProducts(){
      let str = window.localStorage['cart']
      let data = JSON.parse(str)
      let books = data.books
      let id = data.id_user
      let method = this.methodVal
      for(let obj in books){
        let idBook = books[obj].id_book
        let discount = books[obj].amount
        let count = books[obj].count
        let idCart = books[obj].id_cart
        this.buyOneProduct(id,method,idBook,count,discount,idCart)
      }
      delete window.localStorage['cart']
          
    },
    buyOneProduct(id_user,id_payment,id_book,count,discount,id_cart){
        let postData = new FormData()
        postData.append('id_user', id_user)
        postData.append('id_payment', id_payment)
        postData.append('id_book', id_book)
        postData.append('count', count)
        postData.append('discount', discount)

        this.$http.post(myPath + 'application/api/orders/',postData).then(response => {
           console.log(response.body)
        }, response => {
          
        });


        this.$http.delete(myPath + 'application/api/cart/' + id_cart).then(response => {
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
