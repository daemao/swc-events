<template>
  <div class="common-layout">
    <el-container>
      <el-aside width="200px">
        <sidebar/>
      </el-aside>
      <el-main><slot/></el-main>
    </el-container>
  </div>
</template>
<script setup>
import Sidebar from "@/components/Sidebar.vue";
</script>