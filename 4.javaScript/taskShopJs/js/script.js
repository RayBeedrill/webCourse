var productObj = function(obj){
    
    this.data = obj;
    
    var config ={
        id:0,
        title: '',
        price: 0,
        srcMain: '',
        currency: "EUR",
        srcAdditional: [],
        sizes: [],
        color: '',
        category: '',
        desc:'',
    };

    (function (obj) {
        for(val in obj)
        {
            for(setting in config)
            {
                if(val == setting)
                {
                    if(obj[val] != config[setting])
                    {
                        config[setting] = obj[val];
                    }
                }
            }
        }
    }(obj));

    this.printMainProduct = function(){
        //<div class="col-md-4 product">
        //    <img src="images/preview/1.jpg" alt="">
        //    <p class="title">some name - <span class="price">some price</span></p>
        //</div>
        var link = document.createElement('a');
        link.href = 'pages/product.html?id=' + config.id;
        var el = document.createElement('div');
        var img = document.createElement('img');
        var p = document.createElement('p');
        var span = document.createElement('span');
        el.className = 'col-md-4 product';
        
        img.src = config.srcMain;
        img.alt = 'product';
        p.className = 'title';
        span.className = 'price';
        span.innerText = config.price + ' ' + config.currency;
        p.innerHTML =  config.title + ' - ';
        p.appendChild(span);
        el.appendChild(img);
        el.appendChild(p);
        link.appendChild(el);
        return link;
    }

    this.printCurentProductSlider = function(){
        //<div class="slider">    
        //    <div class="slide active">
        //            <img src="../images/preview/1.jpg" alt="">
        //    </div>    
        //    <div class="slide">
        //            <img src="../images/preview/1.jpg" alt="">
        //    </div>    
        //   <div class="slide">
        //            <img src="../images/preview/1.jpg" alt="">
        //    </div>    
        //    <div class="slide">
        //            <img src="../images/preview/1.jpg" alt="">
        //    </div>    
        //</div>
        var container = document.querySelector('.product-slider');
        container.innerHTML = '';
        var slider = document.createElement('div');
        slider.className = 'slider';
        var firstSlideDiv = document.createElement('div');
        firstSlideDiv.className = 'slide active';
        firstSlide = document.createElement('img');
        firstSlide.src = '../' + config.srcMain;
        firstSlide.alt = 'slide';
        firstSlideDiv.appendChild(firstSlide);
        slider.appendChild(firstSlideDiv);
        for(val in config.srcAdditional)
        {
            var slideDiv = document.createElement('div');
            slideDiv.className = 'slide'
            slide = document.createElement('img');
            slide.src = config.srcAdditional[val];
            slide.alt = 'slide';
            slideDiv.appendChild(slide);
            slider.appendChild(slideDiv);
        }
        container.appendChild(slider);
    }

    this.printCurentProductDesc = function()
    {
    //    <h4 class="product-title">
    //      title
    //    </h4>
    //    <p class="product-desc-text">
    //        some desc
    //    </p>
    //    <p class="product-price">
    //        400 EUR
    //    </p>
    //    <select name="size-select" class="select-input select-size-input">
    //        <option value="">size1</option>
    //        <option value="">size2</option>
    //        <option value="">size3</option>
    //    </select>
    //    <button class="buy-button">
    //        add to cart
    //    </button>
        var h4 = document.querySelector('.product-title');
        h4.innerHTML = config.title;
        var pDesc = document.querySelector('.product-desc-text');
        pDesc.innerHTML = config.desc;
        var pPrice = document.querySelector('.product-price');
        pPrice.innerHTML = config.price + ' ' + config.currency;

        var select = document.querySelector('.select-size-input');
        select.innerHTML = '';
        for(val in config.sizes)
        {
            var option = document.createElement('option');
            option.value = config.sizes[val];
            option.innerText = config.sizes[val];
            select.appendChild(option);
        }
    }

}

var getUrlVal = function(){
    var urlString = window.location.search;
    var valueString = urlString.split('?')[1];
    var id = valueString.split('=')[1];
    return id;
}
