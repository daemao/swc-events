<template>
  <UiForm>
    <el-form-item :label="$t('events.name')">
      <el-input v-model="form.name"/>
    </el-form-item>
    <el-form-item :label="$t('events.body')">
      <el-input v-model="form.body"/>
    </el-form-item>
    <el-form-item :label="$t('events.date')">
      <el-date-picker v-model="form.date" value-format="YYYY-MM-DD"/>
    </el-form-item>
    <el-row justify="end">
      <el-button @click="save">{{$t('events.create')}}</el-button>
    </el-row>
  </UiForm>
</template>
<script setup>
import UiForm from "@/components/UiForm.vue";
import {computed, ref, watch} from "vue";
import {ElNotification} from "element-plus";
import axiosInstance from "@/axios";
import {useI18n} from "vue-i18n";
import {useRoute, useRouter} from "vue-router";
import useEventsItem from "@/uses/useEventsItem";
const form = ref({
  name:'',
  body:'',
  date:null
})
const {t} = useI18n();
const router = useRouter()
const save=()=>{
  if(id.value !==undefined){
    axiosInstance.post('/api/events',form.value).then(()=>{
      ElNotification.success(t(`event_created`))
      router.push({name:'events'})
    }).catch(err=>{
      ElNotification.error(err.response.data.message)
    })
  }else{
    axiosInstance.put(`/api/events/${id.value}`,form.value).then(()=>{
      ElNotification.success(t(`event_updated`))
      router.push({name:'events'})
    }).catch(err=>{
      ElNotification.error(err.response.data.message)
    })
  }

}
const route = useRoute()
const id = computed(()=>route.query.id??null)

const {item,getItem} = useEventsItem();

watch(()=>id.value,newVal=>{
  if(newVal){
    getItem(newVal);
  }
},{immediate:true})
watch(()=>item.value,(newVal)=>{
  form.value.name=newVal.name;
  form.value.body=newVal.body;
  form.value.date=newVal.date==="-"?null:newVal.date
},{deep:true,immediate:true})
</script>