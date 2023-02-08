<template>
  <div class="tasks">
    <TaskItem>NULL</TaskItem>
  </div>
</template>

<script>
import TaskItem from "@/plugins/app/_components/z-task-item.vue";

export default {
  name: "ActiveTasks",
  components: {
    TaskItem,
  },
};
</script>
