<template>
  <div id="app">
    <router-view v-on:addToCart="addToCart" v-on:deleteProd="deleteProd" v-on:resetData="resetData"></router-view>
     <router-link  :to="'/cart'">
        <p class="cart-count">{{counterDin}}</p>
     </router-link>
  </div>
</template>

<script>

export default {
  name: 'app',
  data () {
    return {
      countProd:0
    }
  },
  created: function(){
      if(localStorage['data']){
        let data = JSON.parse(localStorage['data']).length
        this.countProd = data
        let count = JSON.stringify(this.countProd)
        localStorage['count'] = count
      }
    },
  methods:{
    addToCart: function(count){
      this.countProd = count
    },
    deleteProd: function(count){
      this.countProd = count
    },
    resetData: function(bool){
      this.countProd = 0
    }
  },
  computed:{
    counterDin:function(){
      return this.countProd
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  color: #2c3e50;
  margin-top: 60px;
}

.cart-count{
    display: inline-block;
    position: fixed;
    bottom: 0;
    right: 40px;
    background-image: url('../static/images/cart.png');
    width: 30px;
    height: 35px;
    text-align: center;
    line-height: 47px;
    font-size: 12px;
    background-position-x: -3px;
}
</style>
