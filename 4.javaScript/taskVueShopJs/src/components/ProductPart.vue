<template>
  <div class="product_section">
    <router-link  :to="'/singleProduct?id=' + product.id">
      <div class="col-md-4 product">
        <img :src="product.srcMain" alt="">
        <p class="title">{{product.title}} - <span class="price">{{product.price.toFixed(2) + ' ' +product.currency}}</span></p>
      </div>
    </router-link>
  </div>
  
</template>

<script>
export default {
  name: 'product',
  data () {
    return {
       
    }
  },
  props: ["product"],
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

</style>
