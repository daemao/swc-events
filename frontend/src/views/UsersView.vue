<template>
  <MainLayout>
    <el-table :data="list">
      <el-table-column prop="name" :label="$t('users.name')"/>
      <el-table-column prop="birthdate" :label="$t('users.birthdate')"/>
      <el-table-column prop="username" :label="$t('users.username')"/>
      <el-table-column prop="created_at" :label="$t('users.registration_date')"/>
    </el-table>
  </MainLayout>
</template>
<script setup>
import MainLayout from "@/layouts/MainLayout.vue";
import {onBeforeUnmount, ref} from "vue";
import useUsersList from "@/uses/useUsersList";
const interval = ref(null);
const {getList, list} = useUsersList();
interval.value = setInterval(()=>getList(),30000)
onBeforeUnmount(()=>clearInterval(interval.value));
getList();
</script>