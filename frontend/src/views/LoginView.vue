<template>
  <AuthLayout>
    <template #left>
      <el-row type="flex" justify="center">
        <el-col :span="15">
          <el-card class="w-100">
              <h1>{{$t('login_page.header')}}</h1>
              <UiForm>
                <el-form-item :label="$t('login_page.login')">
                  <el-input v-model="form.username" autofocus/>
                </el-form-item>
                <el-form-item :label="$t('login_page.password')">
                  <el-input show-password v-model="form.password"/>
                </el-form-item>
                <el-row justify="space-between" align="middle">
                  <router-link :to="{name:'register'}">{{$t('login_page.to_register')}}</router-link>
                  <el-button @click="toLogin">
                    {{$t('login_page.to_login')}}
                  </el-button>
                </el-row>
              </UiForm>
          </el-card>
        </el-col>
      </el-row>
    </template>
    <template #right>
      <el-image src="/images/Login.jpg"/>
    </template>
  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/layouts/AuthLayout.vue";
import UiForm from "@/components/UiForm.vue";
import {ref} from "vue";
import axiosInstance from "@/axios";
import {ElNotification} from "element-plus";
import {useI18n} from "vue-i18n";
import {useRouter} from "vue-router";
const form = ref({
  username:'test',
  password:'123456'
})
const {t} = useI18n();
const router = useRouter()
const toLogin = ()=>{
  if(!form.value.username  || !form.value.password){
    return;
  }
  axiosInstance.get('/sanctum/csrf-cookie').then(response => {
    axiosInstance.post('/api/auth/login',form.value).then(res=>{
      const {access_token,token_type} =  res.data.result;
      localStorage.setItem('token', access_token);
      localStorage.setItem('token_type', token_type);
      axiosInstance.addToken(access_token,token_type)
      axiosInstance.get('/api/user').then(res=>{
        localStorage.setItem('user',JSON.stringify(res.data))
        router.push('/events')
      })
    }).catch(({response})=>{
      ElNotification.error(t(`errors.${response.data.error}`))
    })
  });

}
</script>