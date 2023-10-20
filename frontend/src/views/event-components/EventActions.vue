<template>
  <el-button v-if="permissions.can_subscribe" @click="subscribe" type="primary">
    {{$t('events.subscribe')}}
  </el-button>
  <el-button v-if="permissions.can_unsubscribe" @click="unsubscribe" type="warning">
    {{$t('events.unsubscribe')}}
  </el-button>
  <el-button v-if="permissions.can_delete" @click="deleteEvent" type="danger">
    {{$t('events.delete')}}
  </el-button>
  <el-button v-if="permissions.can_update" @click="update" >
    {{$t('events.update')}}
  </el-button>
</template>
<script setup>
  import axiosInstance from "@/axios";
  import {ElNotification} from "element-plus";
  import {useI18n} from "vue-i18n";
  import {useRouter} from "vue-router";
  const router = useRouter();

  const props= defineProps({
    id:{
      required:true
    },
    permissions:{
      type:Object,
      default:()=>({})
    }
  })
  const emits =defineEmits(['update'])
  const {t} = useI18n();
  const subscribe = ()=>{
    axiosInstance.put(`/api/events/${props.id}/subscribe`).then(()=>{
      ElNotification.success(t('events.subscribed'))
      emits('update')
    })
  }
  const unsubscribe = ()=>{
    axiosInstance.put(`/api/events/${props.id}/unsubscribe`).then(()=>{
      ElNotification.success(t('events.unsubscribed'))
      emits('update')
    })
  }
  const update = ()=>{
    router.push({name:'events-form',query:{id:props.id}})
  }
  const deleteEvent = ()=>{
    axiosInstance.delete(`/api/events/${props.id}`).then(()=>{
      ElNotification.success(t('events.deleted'))
    })
  }
</script>