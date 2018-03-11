var mainPageObj = function(arr){

    this.originArr = arr;
    var productArray = [];

    this.listAllProducts = function(){
        var container = document.querySelector('.content');
        container.innerHTML = '';
        for(val in productArray)
        {
            container.appendChild(productArray[val].printMainProduct());
        }
    }

    this.createProductArray = function(arr,filter){
        if(filter == 'price-up'){
            arr = arr.sort(this.priceCompare);
            productArray = [];
         }
        if(filter == 'price-down'){
            arr = arr.sort(this.priceCompare).reverse();
            productArray = [];
        }
        for(val in arr){
            productArray.push(new productObj(arr[val]));  
        }
    }
    
    this.createProductArray(arr,'none');

    this.showFilterColor = function(){
        var el = document.querySelector('.color-input');
        el.innerHTML = '';
        for(val in color){
           var option = document.createElement('option');
           if(val == 'default'){
            option.attributes += ' selected';
           }
           option.innerText = color[val];
           option.value = color[val];
           el.appendChild(option);
        }
    }


    this.showFilterSize = function(){
        var el = document.querySelector('.sizes-input');
        el.innerHTML = '';
        for(val in sizes){
           var option = document.createElement('option');
           if(val == 'default'){
            sizes[val] = 'Sizes';
            option.attributes += ' selected';
           }
           option.innerText = sizes[val];
           option.value = sizes[val];
           el.appendChild(option);
        }
    }

    this.showFilterCategory = function(){
        var el = document.querySelector('.category-input');
        el.innerHTML = '';
        for(val in category){
           var option = document.createElement('option');
           if(val == 'default'){
            option.attributes += ' selected';
           }
           option.innerText = category[val];
           option.value = category[val];
           el.appendChild(option);
        }
        
    }

    this.showFilterPrice = function(){
        var filterVal = {
            default: 'Sort',
            val1: 'Lowest price first',
            val2: 'Highest price first',
        };
        var el = document.querySelector('.price-input');
        el.innerHTML = '';
        for(val in filterVal){
           var option = document.createElement('option');
           if(val == 'default'){
            option.setAttribute ('selected','');
           }
           option.innerText = filterVal[val];
           option.value = filterVal[val];
           el.appendChild(option);
        }
        this.addEventToFilterPrice(el);
        

    }

    this.addEventToFilterPrice = function(el){    
        var self = this;
        el.addEventListener('change',function(){
            if(el.value == 'Lowest price first')
            {
                self.createProductArray(self.originArr,'price-up');
            }
            if(el.value == 'Highest price first')
            {
                self.createProductArray(self.originArr,'price-down');
            }
            if(el.value == 'Sort')
            {
                self.createProductArray(self.originArr,'none');
            }
            self.listAllProducts();
        });
    }
    this.priceCompare = function (productA, productB) {
        return productA.price - productB.price;
    }


}

var a = new mainPageObj(allProducts);
a.listAllProducts();
a.showFilterColor();
a.showFilterSize();
a.showFilterCategory();
a.showFilterPrice();


