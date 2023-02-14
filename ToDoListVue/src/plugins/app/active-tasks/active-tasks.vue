<template>
  <div class="container">
    <ul class="row justify-content-center list-group mt-3" v-if="areThereActiveTasks">
      <li class="list-group-item" v-for="task in filteredActiveTasks.slice().reverse()" :key="task.id">
        <TaskItem :task="task" @deleteTask="task.completed = true"></TaskItem>
      </li>
    </ul>
    <p class="text-center" v-else>Nie sú žiadne aktívne úlohy.</p>
  </div>
</template>

<script>
import TaskItem from "@/plugins/app/_components/z-task-item.vue";

export default {
  name: "ActiveTasks",
  components: {
    TaskItem,
  },
  computed: {
    areThereActiveTasks() {
      return this.$store.state.tasks.filter((task) => !task.completed) != 0 ? true : false;
    },
    filteredActiveTasks() {
      return this.$store.state.tasks.filter((task) => !task.completed);
    }
  }
};
</script>
