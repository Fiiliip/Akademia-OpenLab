<template>
  <div class="container">
    <ul class="row justify-content-center list-group mt-3" v-if="areThereActiveTasks">
      <li class="list-group-item" v-for="task in this.$store.state.tasks.slice().reverse()" :key="task.id">
        <TaskItem v-if="!task.isDone" :task="task" @deleteTask="task.isDone = true"></TaskItem>
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
      console.log(this.$store.state.tasks.filter((task) => !task.isDone));
      return this.$store.state.tasks.filter((task) => !task.isDone) != 0 ? true : false;
    },
  }
};
</script>
