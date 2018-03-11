


var GaleryEl = function(imageSrc,titleCont,textCont,typeIn)
{
    var image = imageSrc;
    var title = titleCont;
    var text = textCont;
    this.typeBlock = typeIn;
    this.titleTag = 'h3';
    this.container = '.container';

    this.setImage = function(href)
    {
        image = href;
    }

    this.setTitle = function(titleText)
    {
        title = titleText;
    }

    this.setText = function(textContent)
    {
        text = textContent;
    }

    this.getImage = function()
    {
        return image;
    }

    this.getTitle = function()
    {
        return title;
    }

    this.getText = function()
    {
        return text;
    }

    this.drawVariant1 = function()
    {
        var imgEl = document.createElement('img');
        var titleEl = document.createElement(this.titleTag);
        var textEl = document.createElement('p');
        var divEl = document.createElement('div');
        var containerObj = document.querySelector(this.container);
        imgEl.src = this.getImage();
        titleEl.innerHTML = this.getTitle();
        textEl.innerHTML = this.getText();
        divEl.appendChild(imgEl);
        divEl.appendChild(titleEl);
        divEl.appendChild(textEl);
        containerObj.appendChild(divEl);

    }

    this.drawVariant2 = function()
    {
        var imgEl = document.createElement('img');
        var titleEl = document.createElement(this.titleTag);
        var textEl = document.createElement('p');
        var divEl = document.createElement('div');
        var containerObj = document.querySelector(this.container);
        imgEl.src = this.getImage();
        titleEl.innerHTML = this.getTitle();
        textEl.innerHTML = this.getText();
        divEl.appendChild(titleEl);
        divEl.appendChild(textEl);
        divEl.appendChild(imgEl);
        containerObj.appendChild(divEl);
    }
}

var page = {

    arrPic: [
        new GaleryEl('pic1','title','text','cat'),
        new GaleryEl('pic2','title2','text2','dog'),
        new GaleryEl('pic3','title3','text3','cat'),
        new GaleryEl('pic4','title4','text4','dog'),
        new GaleryEl('pic5','title5','text5','cat'),
        new GaleryEl('pic6','title6','text6','dog'),
    
    ],

    draw: function(){
        arr = this.arrPic;
        for(val in arr)
        {
            if(arr[val].typeBlock == 'cat')
            {
                arr[val].drawVariant1();
            }
            else
            {
                arr[val].drawVariant2();
            }
        }
    },

}



page.draw();