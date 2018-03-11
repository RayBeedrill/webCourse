import Vue from 'vue'
import Router from 'vue-router'

import AllBooks from '@/components/product/AllBooks'
import ListBooks from '@/components/product/ListBooks'
import SingleProduct from '@/components/product/SingleProduct'
import SignIn from '@/components/user/SignIn'
import SignUp from '@/components/user/SignUp'
import ByAuthor from '@/components/product/ByAuthor'
import ByGenre from '@/components/product/ByGenre'
import Profile from '@/components/user/Profile'
import UserInfo from '@/components/user/UserInfo'
import UserCart from '@/components/user/UserCart'
import UserOrders from '@/components/user/UserOrders'
import Admin from '@/components/admin/Admin'
import UsersOrders from '@/components/admin/UsersOrders'
import AddBook from '@/components/admin/AddBook'
import AddAuthor from '@/components/admin/AddAuthor'
import AddGenre from '@/components/admin/AddGenre'
import AddUser from '@/components/admin/AddUser'
import AddDiscount from '@/components/admin/AddDiscount'
import EditBook from '@/components/admin/EditBook'
import EditAuthor from '@/components/admin/EditAuthor'
import EditGenre from '@/components/admin/EditGenre'
import EditUser from '@/components/admin/EditUser'
import EditDiscount from '@/components/admin/EditDiscount'

import Orders from '@/components/cart/Orders'
import Checkout from '@/components/cart/Checkout'



Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'AllBooks',
      component: AllBooks
    },
    {
      path: '/admin/listBooks',
      name: 'ListBooks',
      component: ListBooks
    },
    {
      path: '/signin',
      name: 'SignIn',
      component: SignIn
    },
    {
      path: '/signup',
      name: 'SignUp',
      component: SignUp
    },
    {
      path: '/byauthor/:id',
      name: 'ByAuthor',
      component: ByAuthor
    },
    {
      path: '/bygenre/:id',
      name: 'ByGenre',
      component: ByGenre
    },
    {
      path: '/profile',
      name: 'Profile',
      component: Profile,
      children:[
		{	      
          path: 'info',
          component: UserInfo
	    },
	    {
	    	path: 'cart',
	    	component: UserCart
	    },
	    {
	    	path: 'orders',
	    	component: UserOrders
	    },

      ]
    },
    {
      path: '/Admin',
      name: 'Admin',
      component: Admin,
      children:[
		{	      
        	path: 'addBook',
          	component: AddBook  
        },
        {	      
        	path: 'addAuthor',
          	component: AddAuthor  
        },
        {	      
        	path: 'addGenre',
          	component: AddGenre  
        },
        {	      
        	path: 'addUser',
          	component: AddUser  
        },
        {       
          path: 'addDiscount',
            component: AddDiscount  
        },
        {	      
        	path: 'editBook/:id',
          	component: EditBook  
        },
        {	      
        	path: 'editAuthor',
          	component: EditAuthor  
        },
        {	      
        	path: 'editGenre',
          	component: EditGenre  
        },
        {	      
        	path: 'editUser',
          	component: EditUser  
        },
        {       
          path: 'editDiscount',
            component: EditDiscount  
        },
        {	      
        	path: 'orders',
          	component: UsersOrders  
        }
      ]
    },
    {
      path: '/order',
      name: 'Orders',
      component: Orders
    },
    {
      path: '/singleProduct/:id',
      name: 'SingleProduct',
      component: SingleProduct
    },
    {
      path: '/checkout',
      name: 'Checkout',
      component: Checkout
    }
  ]
})
