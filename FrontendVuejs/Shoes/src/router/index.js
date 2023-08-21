import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import HomeView from '../views/HomeView.vue'
import ProductsView from '../views/ProductsView.vue'
import { data } from 'autoprefixer'
import ProductView from '../views/ProductView.vue'
import CartView from '../views/CartView.vue'
import FavoriteProducts from '../views/FavoriteProducts.vue'
import IntroView from '../views/IntroView.vue'
import NotFound from '../views/NotFoundView.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/acount',
      alias: '/acount/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/acount/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/:name',
      name: 'products',
      component: ProductsView,
      beforeEnter: (to, from, next) => {
        var CategoriesNameLc = localStorage.getItem('CategoriesName')
        CategoriesNameLc = JSON.parse(CategoriesNameLc)
        CategoriesNameLc = CategoriesNameLc.map((category) => category.replace(/ /g, '-').toLowerCase())
        const params = to.params.name.replace(/ /g, '-').toLowerCase()
        if (!CategoriesNameLc) {
          store
            .dispatch('fetchCategories')
            .then((data) => {
              data = data.map((data) => data.toLowerCase())
              if (CategoriesNameLc.includes(params)) {
                return next()
              } else {
                next('/404')
              }
            })
            .catch((error) => {
              console.error(error)
            })
        }else {
          if (CategoriesNameLc.includes(params)) {
            next()
          } else {
            next('/404')
          }
        }
      }
    },
    {
      path:'/product',
      name:'product',
      component:ProductView
    },
    {
      path:'/san-pham-yeu-thich',
      name:'FavoriteProducts',
      component:FavoriteProducts
    },
    {
      path:'/gio-hang',
      name:'Carts',
      component:CartView
    },
    {
      path:'/gioi-thieu',
      name:'intro',
      component:IntroView
    },
   
  ]
})

export default router
