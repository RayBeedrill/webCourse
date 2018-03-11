<template>
      <div class="col-md-12 product-class">
        <div class="col-md-6 product-in-cart">
          <div class="col-md-12">
            <p class="title">{{product.title}}</p>
          </div>
          <div class="col-md-4">
            <p class="size-caption">size</p>
            <p class="size-val">{{product.size}}</p>
            <p class="color-caption">color</p>
            <p class="color-val">{{product.color}}</p>
          </div>
          <div class="col-md-6 amout-num">
            <div class="price">
            {{product.price.toFixed(2)  + ' ' +product.currency}}
            </div>
            <div class="counter">
              <button class="btn-counter" v-on:click="counterFunc('minus')">-</button>
              <p class="count":v-model="counter">{{counter}}</p>
              <button class="btn-counter" v-on:click="counterFunc('plus')">+</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 product-image">
          <div class="delete-btn">
            <button class="delete-cart" @click="getId">X</button>
            <img :src="product.srcMain" alt="">
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'cart-list',
  data () {
    return {
      counter:1,
    }
  },
  methods:{
    counterFunc: function(action){
      if(action == 'plus'){
        this.counter++
      }
      if(action == 'minus')
      {
        if(this.counter > 1){
          this.counter--
        }
      }
      let data = {id:this.product.id, count:this.counter}
      this.$emit('setCount', data)
    },
    getId: function(){
      this.$emit('deleteProd', this.product.id)
    }
  },
  props: ["product"],
}
</script>

