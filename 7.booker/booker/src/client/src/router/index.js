import Vue from 'vue'
import Router from 'vue-router'
import Auth from '@/components/Auth'
import Calendar from '@/components/Calendar'
import Book from '@/components/Book'
import EmployeeList from '@/components/EmployeeList'
import EmployeeEdit from '@/components/EmployeeEdit'
import DateEdit from '@/components/DateEdit'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Auth',
      component: Auth
    },
    {
    	path:'/calendar',
    	name:'Calendar',
    	component: Calendar
    },
    {
      path:'/book/:id_room',
      name:'Book',
      component: Book
    },
    {
      path:'/employeeList',
      name:'employeeList',
      component: EmployeeList
    },
    {
      path:'/employeeEdit/:id',
      name:'employeeEdit',
      component: EmployeeEdit
    },
    {
      path:'/employeeEdit/',
      name:'employeeEdit',
      component: EmployeeEdit
    },
    {
      path:'/dateEdit/:year/:month/:day/:id',
      name:'dateEdit',
      component: DateEdit
    },
  ]
})
