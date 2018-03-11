const myPath = 'http://shopvueexam.loc/server/'
//const myPath = 'http://192.168.0.15/~user4/shop/serv/'
const node_mode = false
//const shopHome = 'http://192.168.0.15/~user4/shop/client/#/'
const shopHome = 'http://shopvueexam.loc/'

const currency = " EUR"

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
