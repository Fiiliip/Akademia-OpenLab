<template>
  <div class="container">
    <ul class="row justify-content-center list-group mt-3" v-if="areThereDeletedTasks">
      <li class="list-group-item" v-for="task in filteredDeletedTasks.slice().reverse()" :key="task.id">
        <TaskItem :task="task"></TaskItem>
      </li>
    </ul>
    <p class="text-center" v-else>Nie sú žiadne odstránené úlohy.</p>
  </div>
</template>

<script>
import TaskItem from '@/plugins/app/_components/z-task-item.vue';

export default {
  name: "DeletedTasks",
  components: {
    TaskItem,
  },
  computed: {
    areThereDeletedTasks() {
      return this.$store.state.tasks.filter((task) => task.completed) != 0 ? true : false;
    },
    filteredDeletedTasks() {
      return this.$store.state.tasks.filter((task) => task.completed);
    }
  }
};
</script>
