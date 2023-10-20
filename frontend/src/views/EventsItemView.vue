<template>
  <MainLayout>
    <EventActions :id="item.id" :permissions="item.permissions" @update="getItem(props.id)"/>
    <div v-if="item.id">
      <div>
        <div>
          {{$t('events.name')}}: {{ item.name }}
        </div>
        <div>
          {{$t('events.body')}}: {{ item.body }}
        </div>
        <div>
          {{$t('events.date')}}: {{ item.date }}
        </div>
        <div>
          {{$t('events.author_name')}}: {{item.author.name}}

        </div>
      </div>
      <div>
        {{ item.body }}
      </div>
      <el-table :data="item.users" v-if="item.permissions['can_view_participants']">
        <el-table-column prop="name" :label="$t('users.name')"/>
        <el-table-column prop="birthdate" :label="$t('users.birthdate')"/>
        <el-table-column prop="username" :label="$t('users.username')"/>
        <el-table-column prop="created_at" :label="$t('users.registration_date')"/>
      </el-table>
    </div>
  </MainLayout>
</template>
<script setup>
import MainLayout from "@/layouts/MainLayout.vue";
import useEventsItem from "@/uses/useEventsItem";
import EventActions from "@/views/event-components/EventActions.vue";
const props =defineProps({
  id:{
    required:true,
  }
})
const {item,getItem} = useEventsItem();
getItem(props.id)
</script>