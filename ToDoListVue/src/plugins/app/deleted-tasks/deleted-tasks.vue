<template>
  <div class="container">
    <ul class="row justify-content-center list-group mt-3">
      <li class="list-group-item" v-for="task in this.$store.state.tasks" :key="task.id">
        <TaskItem v-if="task.isDone" :task="task" @deleteTask="deleteTask(task)"></TaskItem>
      </li>
    </ul>
  </div>
</template>

<script>
import TaskItem from '@/plugins/app/_components/z-task-item.vue';

export default {
  name: "DeletedTasks",
  components: {
    TaskItem,
  },
  methods: {
    deleteTask(task) {
      this.$store.state.tasks.splice(this.$store.state.tasks.indexOf(task), 1);
    },
  },
};
</script>
