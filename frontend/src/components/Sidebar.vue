<template>
  <el-menu :router="true" >
    <el-menu-item-group>
      <el-menu-item v-for="route in routes" :index="route.route">
<!--      <el-menu-item v-for="route in filteredRoutes" :index="route.route">-->
        {{$t(`sidebar.${route.label}`)}}
      </el-menu-item>
      <el-menu-item @click="setLocale('ru')">
        {{$t('locales.ru')}}
      </el-menu-item>
      <el-menu-item @click="setLocale('en')">
        {{$t('locales.en')}}
      </el-menu-item>
      <el-menu-item @click="logout">
        {{$t('auth.logout')}}
      </el-menu-item>
    </el-menu-item-group>
  </el-menu>
</template>
<script setup>
import {useRouter} from "vue-router";
import {computed} from "vue";
import i18n from "@/i18n";

const routes = [
  {label:'events',route:'/events',permission:null},
  {label:'events_create',route:'/events/form',permission:'can_create_events'},
  {label:'users',route:'/users',permission:'can_read_users'},
]
const router = useRouter()
const logout = ()=>{
  localStorage.removeItem('user');
  localStorage.removeItem('token')
  localStorage.removeItem('token_type')
  router.push('/');
}
const user= computed(()=>{
  return JSON.parse(localStorage.getItem('user'))
})
const permissions = computed(()=>user.value?.permissions)
const filteredRoutes = computed(()=>routes.filter(el=>!el.permission || permissions.value[el.permission]))

const setLocale = (value)=>{
  i18n.global.locale = value;
  console.log(i18n.global)
  localStorage.setItem('locale', value);
  router.go();
}
</script>