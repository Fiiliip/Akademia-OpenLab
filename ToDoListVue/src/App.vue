<template>
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="text-center fs-2 my-3">ToDo List</h1>
        <div style="max-width: 350px" class="row justify-content-center">
          <p class="mb-1">Zadaj úlohu:</p>
          <div class="d-flex justify-content-center">
            <input type="text" v-model="inputText">
            <button @click="addTask()">Pridaj úlohu</button>
          </div>
        </div>
        <!-- <div id="nav" class="d-flex justify-content-evenly border rounded-pill border-danger py-2 my-3 mx-5">
          <router-link class="text-decoration-none" to="/active">Aktívne</router-link>
          <router-link class="text-decoration-none" to="/deleted">Odstránené</router-link>
        </div> -->
      </div>
      <div style="max-width: 350px" class="mt-3 mx-auto">
        <TaskItem v-for="task in tasks" :key="task.id" :task="task"></TaskItem>
      </div>
    </div>
  <router-view />
</template>

<script>
import TaskItem from "@/plugins/app/_components/z-task-item.vue";

export default {
  name: "App",
  components: {
    TaskItem,
  },

  data() {
    return {
      inputText: "",
      tasks: [
        {
          id: 1,
          title: "Kúpiť 2kg zemiakov.",
          isDone: false,
        },
        {
          id: 2,
          title: "Kúpiť 10ks vajec.",
          isDone: false,
        }
      ]
    }
  },

  methods: {
    addTask() {
      if (this.inputText === "") {
        return;
      }

      this.tasks.push({
        id: this.tasks.length + 1,
        title: this.inputText,
        isDone: false,
      })

      this.inputText = "";

      console.log(`Bola pridaná úloha: ${this.tasks[this.tasks.length - 1].title}`);
    }
  }
};
</script>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;

    font-family: Avenir, Helvetica, Arial, sans-serif;
    letter-spacing: 1px;

    color: #2c3e50; // Vue - default

    -ms-overflow-style: none;

    -webkit-font-smoothing: antialiased; // Vue - default
    -moz-osx-font-smoothing: grayscale; // Vue - default
}

* ::-webkit-scrollbar {
    display: none;
}

#nav {
  max-width: 335px;

  a {
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
