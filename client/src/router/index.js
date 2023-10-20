import Vue from 'vue'
import VueRouter from 'vue-router'
import HomePage from '../components/HomePage.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomePage
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../components/User/LoginPage.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../components/User/RegisterPage.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
