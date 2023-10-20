import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: ()=>import('../views/LoginView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: ()=>import('../views/RegisterView.vue')
    },
    {
      path:'/users',
      name: 'users',
      component: ()=>import('../views/UsersView.vue')
    },
    {
      path:'/events',
      name: 'events',
      component: ()=>import('../views/EventsView.vue')
    },
    {
      path:'/events/form',
      name: 'events-form',
      props:true,
      component: ()=>import('../views/EventsFormView.vue')
    },
    {
      path:'/events/:id',
      name: 'events-item',
      props:true,
      component: ()=>import('../views/EventsItemView.vue')
    },
  ]
})

export default router
