<template>
  <el-form label-position="top" :rules="rules" :model="model" ref="formRef">
    <slot/>
  </el-form>
</template>
<script setup>
import {ref} from "vue";

defineProps({
  labelPosition:{
    type:String,
    default:'top'
  },
  rules:{
    type:Object,
    default:()=>({})
  },
  model:{
    type:Object,
    default:()=>({})
  }
})
const formRef =ref(null);
const validate=  (callback)=>{
  formRef.value.validate((isValid)=>{
    callback(isValid);
  })
}
defineExpose({validate})
</script>