<template>
  <div class="tasks">
    <TaskItem title="Kúpiť 10ks vajec"></TaskItem>  
  </div>
</template>

<script>
// @ is an alias to /src
import TaskItem from "@/components/TaskItem.vue";

export default {
  name: "ActiveTasks",
  components: {
    TaskItem,
  },

  data() {
    return {
      tasks: []
    }
  },

  methods: {
    addTask() {
      
    }
  }
};
</script>

<style>
.tasks {
  border: 1px solid red;
}
</style>
