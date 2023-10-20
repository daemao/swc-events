<template>
  <el-row type="flex" class="min-h-screen" align="middle" >
    <el-col :span="12">
      <slot name="left"/>
    </el-col>
    <el-col :span="12">
      <slot name="right"/>
    </el-col>
    <slot />
  </el-row>
</template>