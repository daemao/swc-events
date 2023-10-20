<template>
  <AuthLayout>
    <template #left>
      <el-image src="/images/Login.jpg"/>
    </template>
    <template #right>
      <el-row type="flex" justify="center">
        <el-col :span="18">
          <el-card class="w-100">
              <h1>{{$t('register_page.header')}}</h1>
              <UiForm :rules="rules" :model="form" ref="formRef">
                <el-form-item :label="$t('register_page.login')" prop="username">
                  <el-input v-model="form.username" autofocus/>
                </el-form-item>
                <el-form-item :label="$t('register_page.first_name')" prop="first_name">
                  <el-input v-model="form.first_name" />
                </el-form-item>
                <el-form-item :label="$t('register_page.last_name')" prop="last_name">
                  <el-input v-model="form.last_name" />
                </el-form-item>
                <el-form-item :label="$t('register_page.birthdate')">
                  <el-date-picker
                      v-model="form.birthdate"
                      type="date"
                  />
                </el-form-item>
                <el-form-item :label="$t('register_page.password')" prop="password">
                  <el-input show-password v-model="form.password"/>
                </el-form-item>
                <el-form-item :label="$t('register_page.password_confirmation')" prop="password_confirmation">
                  <el-input show-password v-model="form.password_confirmation"/>
                </el-form-item>
                <el-row justify="space-between">
                  <router-link :to="{name:'login'}">{{$t('register_page.to_login')}}</router-link>
                  <el-button @click="toRegister">
                    {{$t('register_page.to_register')}}
                  </el-button>
                </el-row>
              </UiForm>
          </el-card>
        </el-col>
      </el-row>
    </template>

  </AuthLayout>
</template>
<script setup>
import AuthLayout from "@/layouts/AuthLayout.vue";
import UiForm from "@/components/UiForm.vue";
import {ref} from "vue";
import {useI18n} from "vue-i18n";
import axiosInstance from "@/axios";
import {ElNotification} from "element-plus";
import {useRouter} from "vue-router";
const form = ref({
  username:'',
  password:'',
  password_confirmation:"",
  birthdate:"",
  first_name:"",
  last_name:""
})
const {t} = useI18n()
const formRef=ref(null);
const rules={
  username:[{required:true,message: t('validators.required')}],
  password:[{required:true,message: t('validators.required')}],
  password_confirmation:[{required:true,message: t('validators.required')}],
  first_name:[{required:true,message: t('validators.required')}],
  last_name:[{required:true,message: t('validators.required')}],
}
const router = useRouter();
const toRegister = ()=>{
  formRef.value.validate(isValid=>{
    if(isValid){
      axiosInstance.post('/api/auth/register',form.value).then(res=>{
        ElNotification.success(t('register_page.registered'))
        router.push('/')
      }).catch(({response})=>{
        ElNotification.error(response.data.message)
      })
    }
  })
  // if(!form.value.username  || !form.value.password){
  //   return;
  // }


}
</script>