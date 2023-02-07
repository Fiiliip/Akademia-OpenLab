<template>
  <div class="tasks">
    <TaskItem title="Kúpiť 10ks vajec"></TaskItem> 
  </div>
</template>

<script>
import TaskItem from "@/components/TaskItem.vue";

export default {
  name: "DeletedTasks",
  components: {
    TaskItem,
  },
};
</script>
