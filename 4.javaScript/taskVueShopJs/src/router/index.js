import Vue from 'vue'
import Router from 'vue-router'
import ProductList from '@/components/ProductList'
import ProductSingle from '@/components/ProductSingle'
import Cart from '@/components/Cart'
import SuccessBuy from '@/components/SuccessBuy'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'ProductList',
      component: ProductList
    },
    {
      path: '/singleProduct',
      name: 'singleProduct',
      component: ProductSingle
    },
    {
      path: '/cart',
      name: 'Cart',
      component: Cart
    },
    {
      path: '/success',
      name: 'SuccessBuy',
      component: SuccessBuy
    },
  ]
})
