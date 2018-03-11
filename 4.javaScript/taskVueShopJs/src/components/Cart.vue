<template>
  <div class="cart">
    <div class="container">
      <div class="col-md-offset-1 col-md-7 cart-list">
        <h2 class="cart-title">Checkout</h2>
        <cart-prod-list v-for="product in setCartListArray" :product="product" v-on:setCount="setCount"  v-on:deleteProd="deleteProd"  :key="product.id"></cart-prod-list>
      </div>
      <cart-form :products="cartProducts" :vouchers="backendVouchers"  :AllPrice="formMoney"></cart-form>
    </div>
  </div>
</template>

<script>
import CartProdList from './CartProdList'
import CartForm from './CartForm'
import myBackend from '../js/myBackend'

export default {
  name: 'cart',
  data () {
    return {
      backendData: myBackend.allProducts,
      backendVouchers: myBackend.allVouchers,
      cartProducts: {},
      locData:[],
      formMoney:{
        totalPrice:0,
        shiping:10,
        tax:20,
        empty:false
      },
      buyData:{},
    }
  },
  components:{
    CartForm,
    CartProdList
  },
  created:
     function(){
      if(typeof window.localStorage['data'] != 'undefined' && window.localStorage['data'] != ''){
      let data = window.localStorage['data']
      this.locData = JSON.parse(data) 
      }
    },
  methods:{
    deleteProd:function(id){
      self = this
      let arr = self.locData

      for(let num in arr){
        if(arr[num].idVal == id){
          arr.splice(num,1)
        }
      }

      if(arr.length == 0){
        this.formMoney.shiping = 0
        this.formMoney.tax = 0
        this.formMoney.empty = true
      }

      self.formMoney.totalPrice = 0
      delete self.cartProducts[id]
      let str = JSON.stringify(arr)
      window.localStorage['data'] = str.trim()
      if(localStorage['data']){
        let count = JSON.parse(localStorage['data']).length
        localStorage['count'] = count
        self.$emit('deleteProd',count)
      }
    },
    setCount: function(countVal){
      let self = this
      
      for(let val in self.cartProducts){
        if(self.cartProducts[val].id == countVal.id){
          self.cartProducts[val].price = (self.cartProducts[val].price / self.cartProducts[val].count) * countVal.count
          self.cartProducts[val].count = countVal.count
        }
      }
    },
  },
  computed:{
    setCartListArray: function(){
      let self = this
      let data = self.locData
      self.formMoney.totalPrice = 0
      for(let val in data){
        for(let prod in self.backendData){
          if(data[val].idVal == self.backendData[prod].id){
            let id = data[val].idVal
            let size = data[val].size 
            self.cartProducts[id] = self.backendData[prod]
            self.cartProducts[id].size = size
            self.formMoney.totalPrice += self.cartProducts[id].price
            
          }
        }
      }
      return self.cartProducts
    },
  }

}
</script>

