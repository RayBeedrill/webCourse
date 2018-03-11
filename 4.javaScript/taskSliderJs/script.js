function slider(sliderClass)
{
    this.width = 600;
    this.height = 450;
    this.previewWidth = 50;
    this.previewHeight = 50;
    this.arrowWidth = 100;
    this.counter = 1;
    this.showPreview = true;
    this.showArrows = true;
    this.srcLeft = 'images/arrow-left.png';
    this.srcRight = 'images/arrow-right.png';

    this.setWidth = function(width)
    {
        this.width = width;
    }
    this.setHeight = function(height)
    {
        this.height = height;
    }

    this.setPreviewWidth = function(previewWidth)
    {
        this.previewWidth = previewWidth;
    }
    this.setPreviewHeight = function(previewHeight)
    {
        this.previewHeight = previewHeight;
    }
    this.setArrowWidth = function(width)
    {
        this.arrowWidth = width;
    }
    this.setShowPreview = function(boolVal)
    {
        this.showPreview = boolVal;
    }
    this.setShowArrows = function(boolVal)
    {
        this.showArrows = boolVal;
    }
    this.setLeftArrow = function(src)
    {
        this.srcLeft = src;
    }
    this.setRightArrow = function(src)
    {
        this.srcRight = src;
    }
    

    this.goTo = function (num)
    {
        
        if(num > this.counter)
        {
            var steps = num - this.counter;
            for( var i = steps; i != 0; i--)
            {
                this.moveLeft();
            }            
        }
        else
        {
            var steps = this.counter - num;
            for( var i = steps; i != 0; i--)
            {
                this.moveRight();
            }
        }
    }

    this.moveLeft = function ()
    {
        var active = document.querySelector('.slide.active');
        var activePreview = document.querySelector('.previewImg.active');
        var sliders = document.querySelectorAll('.slide');
        var lstChild = sliders[sliders.length -1];
        var lstChildPos = lstChild.style.left
        if(lstChildPos != '0px')
        {
            active.className = 'slide';
            active.nextElementSibling.className += ' active';
            if(activePreview != null)
            {
                activePreview.className = 'previewImg';
                activePreview.nextElementSibling.className += ' active';
            }
            for(val in sliders)
            {
                if ( !sliders.hasOwnProperty(val) ) {
                    continue;
                }
                
                    var curPos = parseInt(sliders[val].style.left);
                    var futPos = curPos - this.width;
                    sliders[val].style.left = futPos + 'px';
                
            }
            
            this.counter++;
        }
    }
    
    this.moveRight = function ()
    {
        var active = document.querySelector('.slide.active');
        var activePreview = document.querySelector('.previewImg.active');
        var sliders = document.querySelectorAll('.slide');
        var fstChild = sliders[0];
        var fstChildPos = fstChild.style.left
        if(fstChildPos != '0px')
        {
            active.className = 'slide';
            active.previousElementSibling.className += ' active';
            if(activePreview != null)
            {
                activePreview.className = 'previewImg';
                activePreview.previousElementSibling.className += ' active';
            }
            for(val in sliders)
            {
                if ( !sliders.hasOwnProperty(val) ) {
                    continue;
                }
                
                    var curPos = parseInt(sliders[val].style.left);
                    var futPos = curPos + this.width;
                    sliders[val].style.left = futPos + 'px';
                
            }
            
            this.counter--;
        }
    }

    this.createPreview = function()
    {
        var container = document.querySelector('.GeeksSlider');
        
        var preview = document.createElement("div");
        preview.className = "geek-preview";
        container.appendChild(preview);
        var images = document.querySelectorAll('.slide > img');
        for(val in images)
        {   
            if ( !images.hasOwnProperty(val) ) {
                continue;
            }
            var shortImg = images[val].cloneNode();
            shortImg.style.width = this.previewWidth + 'px';
            shortImg.style.height = this.previewHeight + 'px';
            shortImg.className = 'previewImg';
            shortImg.setAttribute('count', ++val);
            preview.appendChild(shortImg);
        }
        var previewParent = document.querySelector(".geek-preview");
        var fstChild = previewParent.firstElementChild.className += ' active';
        this.previewEventListners();

    }

    this.previewEventListners = function()
    {   
        var self = this;
        var preview = document.querySelectorAll('.previewImg');
        for(val in preview)
        {
            if ( !preview.hasOwnProperty(val) ) {
                continue;
            }
            preview[val].addEventListener('click',function(){
                var num = this.getAttribute('count');
                self.goTo(num);   
            });
        }
    }
    

    this.createArrow = function(nameClass,imgSrc)
    {
        var self = this;
        var container = document.querySelector(sliderClass);
        var parent = container.parentNode;
        var div = document.createElement("div");
        div.className = nameClass;
        div.style.width =  this.arrowWidth + 'px';
        parent.insertBefore(div,container);
        var arrowEl = document.createElement('img');
        arrowEl.src = imgSrc;
        div.appendChild(arrowEl);
    }

    this.addRightAction = function(nameClass)
    {
        var self = this;
        var node = document.querySelector(nameClass);

        node.addEventListener('click',function(){
            self.moveLeft();   
        });
    }

    this.addLeftAction = function(nameClass)
    {
        var self = this;
        var node = document.querySelector(nameClass);

        node.addEventListener('click',function(){
            self.moveRight();   
        });
    }

    this.startSlider = function()
    {
       
        var container = document.querySelector(sliderClass);
        container.style.width = this.width + 'px';
        container.style.height = this.height + 'px';
        container.style.overflow = 'hidden';
        container.style.position = 'relative';
        var parent = container.parentNode;
        var div = document.createElement("div");
        div.className = 'GeeksSlider';
        div.style.width = this.width + 'px';
        div.style.margin = '0 auto';
        parent.insertBefore(div,container);
        div.appendChild(container);
        var images = document.querySelectorAll('.slide');
        
        var pixels = 0;
        for(val in images)
        {
            if ( !images.hasOwnProperty(val) ) {
                continue;
            }
            
            images[val].style.left = pixels + 'px';
            pixels += this.width;
        }
        if(this.showPreview)
        {
            this.createPreview();
        }

        if(this.showArrows)
        {
            var leftArrowClass = 'left-arrow';
            var rightArrowClass = 'right-arrow';
            this.createArrow(leftArrowClass,this.srcLeft);
            this.createArrow(rightArrowClass,this.srcRight);
            this.addLeftAction('.' + leftArrowClass);
            this.addRightAction('.' + rightArrowClass);
        }
    }

}

var slider = new slider('.geek-slider');
slider.setWidth(755);
slider.startSlider();