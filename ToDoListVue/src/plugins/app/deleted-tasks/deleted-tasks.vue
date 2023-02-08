<template>
  <div class="tasks">
    <TaskItem title="Kúpiť 10ks vajec"></TaskItem> 
  </div>
</template>

<script>
import TaskItem from '@/plugins/app/_components/z-task-item.vue';

export default {
  name: "DeletedTasks",
  components: {
    TaskItem,
  },
};
</script>
