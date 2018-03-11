<template>
  <div class="product-single">
<div class="container">
	<div class="row product-desc">
		<div class="col-md-5">
		<slick class="slider-for" ref="slick" :options="slickOptions">
			<img :src="currentProduct.srcMain" alt="">
			<img v-for="link in currentProduct.srcAdditional" :src="link" :key="link" alt="">
		</slick>
		<slick class="slider-nav" ref="slick" :options="navOptions">
			<img :src="currentProduct.srcMain" alt="">
			<img v-for="link in currentProduct.srcAdditional" :src="link" :key="link" alt="">
		</slick>
		</div>
		<div class="col-md-7 product-info">
						<div class="product-desc">
							<div class="text-product">
								<h4 class="product-title">
										{{currentProduct.title}}
								</h4>
								<p class="product-desc-text">
										{{currentProduct.desc}}
								</p>
								<p class="product-price">
										{{currentProduct.price.toFixed(2) + ' ' + currentProduct.currency}}
								</p>
							</div>	
								<select  name="size-select" v-model="choosenSize" class="select-input select-size-input">  
										<option v-for="size in currentProduct.sizes" :key="size" :value="size">{{size}}</option>
								</select>
								<a v-bind:href="cartUrl" class="buy-button" v-on:click="addToCart">
										{{addToCartText}}
								</a>

                <p class="err-msg">{{msg}}</p>
						</div>
				</div>
		 </div>				
		</div>				
  </div>
</template>

<script>
import Slick from 'vue-slick'
import myBackend from '../js/myBackend'
export default {
  name: 'product-single',
		data () {
			return {
				idProduct:'',
				addToCartText: 'add to cart',
        proceedToCheckoutText: 'proceed to checkout',
        cartUrl: undefined,
        choosenSize:'choose size',
        productInCart: false,
        msg: '',
        slickOptions: {
        	slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					fade: true,
					asNavFor: '.slider-nav',
					autoplay: true,
  				autoplaySpeed: 2000,
				},
				navOptions:{
					slidesToShow: 3,
					slidesToScroll: 1,
					asNavFor: '.slider-for',
					centerMode: true,
					focusOnSelect: true,
					arrows:false
				},
				dataProducts: myBackend.allProducts,
				currentProduct:''
		}
	},
	created:function(){
			let self = this
			self.checkData()
			self.idProduct = self.getIdProduct()
			let product = self.chooseProduct(self.idProduct)
			self.currentProduct = product;
			if(self.productInCart){
				self.proceedToChekout()
			}
	},
	components:{
		Slick
	},
	methods:{
		chooseProduct: function(id){
			
			for(let val in this.dataProducts){
				if(this.dataProducts[val].id == id){
					return this.dataProducts[val]
				}
			}
		},
		getIdProduct: function(){
			let urlString = window.location.hash;
			let valueString = urlString.split('?')[1];
			let id = valueString.split('=')[1];
			return id;
		},
    addToCart: function(){
			let self = this
      if(self.choosenSize != 'choose size' && self.addToCartText != self.proceedToCheckoutText){
        self.proceedToChekout()
				if(!self.productInCart){
					self.writeData()
					if(localStorage['data']){
						let count = JSON.parse(localStorage['data']).length
						localStorage['count'] = count
						self.$emit('addToCart',count)
					}
				}
      }else{
        if(self.choosenSize == 'choose size' && self.addToCartText != self.proceedToCheckoutText){
          self.msg = 'choose size please'
        }
      }
    },
		writeData: function(){
		var arr = [];

    var data = {
        idVal:this.idProduct,
        size:this.choosenSize,
    };

		if(typeof localStorage['data'] != 'undefined' && localStorage['data'] != ''){
			arr = JSON.parse(localStorage['data'])	
		}

		arr.push(data)
    localStorage['data'] = JSON.stringify(arr);
		},
		checkData:function(){
			var data = localStorage['data'];
			let self = this
			if(typeof data != "undefined"){
					if(data.indexOf(self.getIdProduct()) > -1){
							self.productInCart = true
							return true
					}
			}
			return false
		},
		proceedToChekout: function(){
			let self = this
			self.addToCartText = self.proceedToCheckoutText
      setTimeout(function(){
          self.cartUrl = '#/cart'  
			},500)
		}
	}
	
}
</script>
<style>
.product-title, 
.product-desc-text, 
.product-price{
	text-align: left;
}
</style>


