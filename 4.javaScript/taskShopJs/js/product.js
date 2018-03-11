var id = getUrlVal();
var product = new productObj(allProducts[id-1]);

product.printCurentProductDesc();
product.printCurentProductSlider();


var proceedCheckout = function(time){
    var btn = document.querySelector('.buy-button');
    setTimeout(function(){
        btn.innerHTML = 'proceed to checkout';
        btn.href = 'cart.html';
    },time);
}

var checkData = function(){
    var data = localStorage['data'];
    if(typeof data != "undefined"){
        if(data.indexOf(id) > -1){
            proceedCheckout(0);
        }
    }
    
}

var addToCart = function(){
    var btn = document.querySelector('.buy-button');
    checkData();
    btn.addEventListener('click',function(){
        var select = document.querySelector('.select-size-input');
        if(select.value != 'choose size' && btn.innerText != 'proceed to checkout'){
            proceedCheckout(250);
            var msg = document.querySelector('.err-msg');
            if(msg){
                msg.remove();
            }
            var size = select.value;
            saveData(size);
        }else{
            if(btn.innerText != 'proceed to checkout' ){
                var msg = document.querySelector('.err-msg');
                if(!msg){
                    var container = document.querySelector('.product-info');
                    var p = document.createElement('p');
                    p.innerText = 'Please choose size';
                    p.style.color = 'red';
                    p.style.textAlign = 'center';
                    p.style.marginTop = '15px';
                    p.className = 'err-msg';
                    container.appendChild(p);
                }
            }
        }
    });
}

addToCart();

var saveData = function(val){
    var arr = [];
    var dataLoc = localStorage['data'];
    if(typeof dataLoc != "undefined"){
        var arrLoc = dataLoc.split(' ');
        for(valArr in arrLoc){
            arr.push(arrLoc[valArr]);
        }
    }

    var data = {
        idVal:id,
        size:val,
    };
    arr.push(JSON.stringify(data));
    var str = arr.join(' ');
    localStorage['data'] = str;
}


