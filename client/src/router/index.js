import Vue from 'vue'
import VueRouter from 'vue-router'
import HomePage from '../components/HomePage.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomePage
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../components/User/LoginPage.vue')
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../components/User/RegisterPage.vue')
  },
  {
    path: '/new_post',
    name: 'New Blog',
    component: () => import('../views/BlogPost.vue')
  },
  {
    path: '/blog/:id',
    name: 'Blog',
    component: () => import('../views/BlogPostView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
