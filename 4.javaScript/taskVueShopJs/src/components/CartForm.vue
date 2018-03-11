<template>
		<div class="col-md-3 cart-form">
      
      <div class="vaucher-form">
        <p class="vaucher-title">Voucher code</p>
        <input v-model="voucher" type="text" class="vaucher-code input-shop">
        <button v-on:click="checkVoucher()" type="submit" class="btn-shop submit">submit</button>
      </div>
      <div class="total-price">
        <table class="result-table">
          <tr>
            <td>Basket:</td>
            <td>{{AllPrice.totalPrice.toFixed(2)}}</td>
          </tr>
          <tr>
            <td>Voucher reduction:</td>
            <td>{{voucherReductionAmount.toFixed(2)}}</td>
          </tr>
          <tr>
            <td>Shiping:</td>
            <td>{{this.AllPrice.shiping.toFixed(2)}}</td>
          </tr>
          <tr class="grand-total">
            <td><strong>Grand Total:</strong></td>
            <td><strong>{{grandTotalCount.toFixed(2) + ' ' + 'EUR'}}</strong></td>
          </tr>
          <tr>
            <td><i>Tax(included):</i></td>
            <td>{{this.AllPrice.tax.toFixed(2)}}</td>
          </tr>
        </table>
      </div>
      <div class="payment-method">
        <div class="payment-list">
        </div>
      </div>
      <div class="user-form">
        <p class="user-form-title">Your details</p>
        <input v-bind:class="{'err-input': inputFname}" v-model="fname" type="text" name="fname" placeholder="First Name"  class="input-shop" >
        <input v-model="lname" type="text" name="lname" placeholder="Last Name"  class="input-shop" >
        <input v-bind:class="{'err-input': inputEmail}" v-model="email" type="text" name="email" placeholder="Email"  class="input-shop" >
        <input v-bind:class="{'err-input': inputTel}" v-model="tel" type="text" name="tel" placeholder="Telephone"  class="input-shop" >
        <input v-bind:class="{'err-input': inputAdress1}" v-model="address1" type="text" name="address1" placeholder="Addres Line 1"  class="input-shop" >
        <input v-model="address2" type="text" name="address2" placeholder="Addres Line 2"  class="input-shop" >
        <input v-model="post" type="text" name="post" placeholder="Postcode"  class="input-shop" >
        <input v-bind:class="{'err-input': inputCity}" v-model="city" type="text" name="city" placeholder="City"  class="input-shop" >
        <select v-bind:class="{'err-input': inputCountry}" v-model="country" class="country-select input-shop" name="country" id="">
          <option value="1">Choose country</option>
          <option value="country 1">Country 1</option>
          <option value="country 2">Country 2</option>
          <option value="country 3">Country 3</option>
        </select>
      </div>
      <div class="send-data">
        <div class="agreement-list">
          <ul>
            <li  v-on:click="agreementCheck('agreement1')"><div v-bind:class="{active:agreement1}" class="cube-list"></div><span>some agreement text</span></li>
            <li v-on:click="agreementCheck('agreement2')"><div v-bind:class="{active:agreement2}"class="cube-list"></div><span>some agreement text</span></li>
          </ul>
        </div>
        <a v-bind:href="successUrl" v-on:click="formValidate" class="btn-shop complete">
          Complete Purchase
        </a>
        <p v-bind:class="{'err-msg' :errMsg, 'err-succ':sucMsg}" >{{msg}}</p>
      </div>
		</div>
</template>

<script>
export default {
  name: 'cart-form',
  data () {
    return {
      fname:'',
      lname:'',
      email:'',
      tel:'',
      address1:'',
      address2:'',
      post:'',
      city:'',
      country:1,
      agreement1:false,
      agreement2:false,
      voucher:'',
      voucherUsed:false,
      voucherReduction:0,
      voucherReductionAmount:0,
      grandTotal: 0,
      prodList: this.products,
      msg:'',
      errMsgText:'some fields are required',
      sucMsgText:'purchese succes',
      errMsg:false,
      sucMsg:false,
      inputFname: false,
      inputEmail: false,
      inputTel: false,
      inputCity: false,
      inputAdress1: false,
      inputCountry: false,
      successUrl:undefined

    }
  },
  props:['products','vouchers','AllPrice'],

  computed:{
    grandTotalCount: function(){
      if(this.AllPrice.empty){
        return this.grandTotal = 0
      }
      this.reducePrice(this.AllPrice.totalPrice,this.voucherReduction)
      this.grandTotal = this.AllPrice.totalPrice + this.AllPrice.tax + this.AllPrice.shiping - this.voucherReductionAmount
      return this.grandTotal
    },
  },
  methods:{
    reducePrice: function(price,param){
      let amount = 0
      if(this.voucher == this.vouchers[0]){
         amount = price * param
      }
      if(this.voucher == this.vouchers[1]){
         amount =  param
      }
      
      this.voucherReductionAmount = amount
    },
    agreementCheck:function(el){
      if('agreement1' == el){
        this.agreement1 = !this.agreement1
      }
      if('agreement2' == el){
        this.agreement2 = !this.agreement2
      }
    },
    checkVoucher: function(){
      if(!this.voucherUsed){
          if(this.voucher == this.vouchers[0]){
            let price = this.grandTotal
            let disc = 0.1
            this.voucherReduction = disc
            this.voucherUsed = true
          }
          if(this.voucher == this.vouchers[1]){
            this.voucherReduction = 5
            this.voucherUsed = true
          }
      }
    },
    formValidate: function(){
      
      if(!(this.fname.length > 3)){
        this.inputFname = true
      }
      else{
        this.inputFname = false
      }
      if(!(this.email.indexOf('@') > 0)){
        this.inputEmail = true
      }else{
        this.inputEmail = false
      }
      if(this.tel == ''){
        this.inputTel = true
      }else{
        this.inputTel = false
      }
      if(this.address1 == ''){
        this.inputAdress1 = true
      }else{
        this.inputAdress1 = false
      }
      if(this.city == ''){
        this.inputCity = true
      }else{
        this.inputCity = false
      }
      if(this.country == '1'){
        this.inputCountry = true
      }else{
        this.inputCountry = false
      }

      switch(true){
        case this.inputFname: this.errMsg = true 
        break
        case this.inputEmail: this.errMsg = true
        break
        case this.inputTel: this.errMsg = true
        break
        case this.inputAdress1: this.errMsg = true
        break
        case this.inputCity: this.errMsg = true
        break
        case this.inputCountry: this.errMsg = true
        break
        default: this.errMsg = false
      }
      if(this.errMsg){
        this.msg = this.errMsgText
        this.errMsg = true
        this.sucMsg = false
      }
      if(!this.errMsg){
        this.msg = this.sucMsgText
        this.sucMsg = true
        this.errMsg = false
        this.collectBuyData()
        this.resetForm()
        this.successUrl = '#/success'
      }
    },
    resetForm:function(){
      this.fname = ''
      this.lname = ''
      this.email = ''
      this.tel = ''
      this.address1 = ''
      this.address2 = ''
      this.post = ''
      this.city = ''
      this.country = '1'
      this.agreement1 =''
      this.agreement2 =''
      this.grandTotal = 0
      this.voucherUsed = false
      this.AllPrice.shiping  = 0
      this.AllPrice.tax = 0
      localStorage['data'] = '[]'
      this.AllPrice.empty = true
    },
    collectBuyData: function(){
      let data = {}
      data.totalSum = this.grandTotal
      data.productList = this.prodList
      data.fname = this.fname
      data.lname = this.lname
      data.email = this.email
      data.tel = this.tel
      data.address1 = this.address1
      data.address2 = this.address2
      data.post = this.post
      data.city = this.city
      data.country = this.country
      data.agreement1 = this.agreement1
      data.agreement2 = this.agreement2
      data.voucher = this.voucher
      data.voucherReduction = this.voucherReduction
      data.voucherReductionAmount = this.voucherReductionAmount
      data.tax = this.AllPrice.tax
      data.shiping = this.AllPrice.shiping
      let str = JSON.stringify(data)
      localStorage['buyList'] = str
      return data
    }
  }
  
}
</script>

<style>
  .cart-form .input-shop.err-input{
    border-color:red;
  }

</style>
