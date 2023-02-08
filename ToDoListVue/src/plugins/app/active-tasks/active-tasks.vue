<template>
  <div class="tasks">
    <TaskItem title="Kúpiť 10ks vajec"></TaskItem>
    <input type="text" v-model="inputText">  
    <button @click="addTask()"></button>
  </div>
</template>

<script>
import TaskItem from "@/plugins/app/_components/z-task-item.vue";

export default {
  name: "ActiveTasks",
  components: {
    TaskItem,
  },

  data() {
    return {
      inputText: "",
      tasks: []
    }
  },

  methods: {
    addTask() {
      this.tasks.push()
    }
  }
};
</script>

<style>
.tasks {
  border: 1px solid red;
}
</style>
