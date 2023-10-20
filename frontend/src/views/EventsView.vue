<template>
  <MainLayout>
    <el-table :data="list" @row-click="handleRowClick">
      <el-table-column label="ID" prop="id"/>
      <el-table-column :label="$t('events.name')" prop="name"/>
      <el-table-column :label="$t('events.body')" prop="body"/>
      <el-table-column :label="$t('events.date')" prop="date"/>
      <el-table-column :label="$t('events.author_name')" prop="author_name"/>
    </el-table>
  </MainLayout>
</template>
<script setup>
import MainLayout from "@/layouts/MainLayout.vue";
import useEventsList from "@/uses/useEventsList";
import {onBeforeUnmount, ref} from "vue";
import {useRouter} from "vue-router";
//data related
const {list,getList} = useEventsList();
const interval = ref(null);
interval.value = setInterval(()=>getList(),30000)
onBeforeUnmount(()=>clearInterval(interval.value));
getList();
//table related
const router = useRouter()
const handleRowClick = ({id})=>{
  router.push({name:'events-item',params:{id}})
}
</script>