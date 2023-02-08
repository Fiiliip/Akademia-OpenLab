<template>
  <div class="container">
    <ul class="row justify-content-center list-group mt-3">
      <li class="list-group-item" v-for="task in this.$store.state.tasks" :key="task.id">
        <TaskItem v-if="!task.isDone" :task="task" @deleteTask="task.isDone = true"></TaskItem>
      </li>
    </ul>
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
