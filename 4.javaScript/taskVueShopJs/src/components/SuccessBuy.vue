<template>
  <div class="success">
    <div class="container">
        <div class="col-md-12">
          <h2 class="page-title">congratulations</h2>
          <p class="page-text">here your check:</p>  
          <h3>Products:</h3>
          <success-product v-for="product in products" :list="product" :key="product.id"></success-product>
          <table class="table table-bordered table-condensed td-width">
            <thead>
              <tr class="active">
                <td>Tax</td>
               <td>Shiping</td>
               <td>Voucher reduction amount</td>
               <td>Total price</td>
              </tr>
            </thead>
            <tbody>
              <tr class="info">
                <td>{{info.tax}}</td>
                <td>{{info.shiping}}</td>
                <td>{{info.voucherReductionAmount}}</td>
                <td>{{totalPrice}}</td>
              </tr>
            </tbody>
          </table>
          <h3>Yours Information</h3>
          <table class="table table-bordered table-condensed td-width table-striped">
            <thead>
              <tr class="active">
                <td>name</td>
                <td>value</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>first name</td>
              <td>{{info.fname}}</td>
              </tr>
              <tr>
                <td>last name</td>
                <td>{{info.lname}}</td>
              </tr>
              <tr>
                <td>email</td>
                <td>{{info.email}}</td>
              </tr>
              <tr>
                <td>telephone</td>
                <td>{{info.tel}}</td>
              </tr>
              <tr>
                <td>first address</td>
                <td>{{info.address1}}</td>
              </tr>
              <tr>
                <td>second address</td>
                <td>{{info.address2}}</td>
              </tr>
              <tr>
                <td>post code</td>
                <td>{{info.post}}</td>
              </tr>
              <tr>
                <td>country</td>
                <td>{{info.country}}</td>
              </tr>
              <tr>
                <td>city</td>
                <td>{{info.city}}</td>
              </tr>
            </tbody>
          </table>
          <div style="text-align:center;margin-bottom:20px;">
            <router-link  :to="'/'">
            <p class="btn btn-primary" v-on:click="resetData">Submit</p>
            </router-link>   
          </div>
        </div>
   
    </div>
  </div>
</template>

<script>
import myBackend from '../js/myBackend'
import SuccessProduct from './SuccessProduct'
export default {
  name: 'SuccessBuy',
  data () {
    return {
      products:{},
      totalPrice:'',
      info:{}
    }
  },
  created:
    function(){
      if(localStorage['buyList']){
      let data = localStorage['buyList']
      data = JSON.parse(data)
      
      this.totalPrice = data.totalSum.toFixed(2)
      this.products = data.productList
      this.info.fname = data.fname
      this.info.lname = data.lname
      this.info.email = data.email
      this.info.tel = data.tel
      this.info.address1 = data.address1
      this.info.address2 = data.address2
      this.info.post = data.post
      this.info.city = data.city
      this.info.country = data.country
      this.info.agreement1 = data.agreement1
      this.info.agreement2 = data.agreement2
      this.info.voucher = data.voucher
      this.info.voucherReduction = data.voucherReduction
      this.info.voucherReductionAmount = data.voucherReductionAmount.toFixed(2)
      this.info.tax = data.tax.toFixed(2)
      this.info.shiping = data.shiping.toFixed(2)
      }
      
  },
  components:{
    SuccessProduct
  },
  methods:{
    resetData:function(){
      delete localStorage['data']
      delete localStorage['buyList']
      delete localStorage['count']
      this.$emit('resetData',true)
    }
  }

}
</script>
<style>
h4,h3,h2,p{
  text-align: center
}
table{
  margin:0 auto
}

.td-width td{
  width:435px;
}
</style>
