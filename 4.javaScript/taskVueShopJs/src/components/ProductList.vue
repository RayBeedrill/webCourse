<template>
  <div class="filter_section">
    <div class="container">
			<div class="row header">
        <div class="col-md-12 header-text">
              <h3>Shop</h3>
              <p>Susutainable Streetwear from DEDICATED, Organic and Fairtrade cortifided cotton, browse and filter below</p>
        </div>
			</div>
      <div class="row">
        <div class="col-md-2">
					
				</div>
        <div class="col-md-2">
          <select id="category" class="select-input price-input" v-model="category">
            <option value="">Category</option>    
            <option v-for="category in  options.categories" :value="category.value" :key="category.value">
              {{category.title}}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="color" class="select-input price-input" v-model="color">
            <option value="">Color</option>    
            <option v-for="color in  options.colors" :value="color.value" :key="color.value">
              {{color.title}}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="size" class="select-input price-input" v-model="size">
            <option value="">Size</option>    
            <option v-for="size in  options.sizes" :value="size.value" :key="size.value">  
              {{size.title}}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <select id="sort" class="select-input price-input" v-model="sort">
            <option value="">Sort</option>    
            <option v-for="sort in  options.sorts" :value="sort.value" :key="sort.value">
              {{sort.title}}
            </option>
          </select>
        </div>
        <div class="col-md-2">
          <div class="clear-filter">
              <button class="clear-filter-button" v-on:click="resetFilter" >clear filter</button>
              <p class="clear-filter-cross">X</p>
          </div>
        </div>
      </div>
      <div class="row content">
        <one-product v-for="product in listFilter" :product="product" :key="product.id" ></one-product>
      </div>
    </div>
  </div>
  
</template>

<script>
import myBackend from '../js/myBackend'
import Product from './ProductPart'
export default {
  name: 'product_list',
  data () {
    return {
      category: '',
      size: '',
      color: '',
      sort: '',
      options: {
        categories:myBackend.allCategory,
        sizes: myBackend.allSizes,
        colors: myBackend.allColors,
        sorts: myBackend.allSorts
      },
      dataProducts: myBackend.allProducts,
      dataFilters: myBackend.allFilters,
    }
  },
  components:{
    'one-product': Product
  },
  methods:{
    resetFilter: function(){
      this.category = ''
      this.size = ''
      this.color = ''
      this.sort = ''
    }
  },
  computed:{
    listFilter: function(){
      let self = this
      var checkCategory = function(el){
         if(self.category == "" || el.category == self.category){
          return true
        }
        return false
      }
      var checkSize = (el) => {
         if(self.size == "" || el.sizes.indexOf(self.size) > -1){
          return true
        }
        
        return false
        
      }
      var checkColor = (el) => {
         if(self.color == "" || el.color == self.color){
          return true
        }
        return false
      }
      
      var result =  this.dataProducts.filter(function(el){
       
        return checkSize(el) && checkCategory(el) && checkColor(el)
      })
        if(self.sort != ''){
          result.sort(function(a,b){
            if(a.price > b.price){
              return 1
            }else if(a.price < b.price){
              return -1
            }
            return 0
          })
          if(self.sort == 'down'){
            return result.reverse()
          }
        }
          
        

      return result;
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

</style>
