<template>
  <div class="container mt-3">
    <h1 class="text-center">ToDo List</h1>
    <div class="d-flex justify-content-center">
      <button class="btn btn-light me-1" @click="downloadData()"><img src="../public/assets/download.svg" alt="Stiahni dáta zo serveru."></button>
      <button class="btn btn-light ms-1" @click="uploadData()"><img src="../public/assets/upload.svg" alt="Nahraj dáta na server."></button>
    </div>
    <div class="input-group mt-3 mx-auto">
      <input type="text" class="form-control" v-model="inputText" placeholder="Zadaj úlohu...">
      <button class="btn btn-outline-secondary" type="button" @click="addTask()">Pridaj úlohu</button>
    </div>
    <div id="nav" class="d-flex justify-content-evenly border rounded-pill py-2 my-3 mx-auto">
      <router-link class="text-decoration-none" to="/active">Aktívne ({{ activeTasksCount }})</router-link>
      <router-link class="text-decoration-none" to="/deleted">Odstránené ({{ deletedTasksCount }})</router-link>
    </div>
  </div>
  <router-view />
</template>

<script>
import axios from "axios";

export default {
  name: "App",
  data() {
    return {
      inputText: "",
    }
  },
  methods: {
    addTask() {
      if (this.inputText != "") {
        this.$store.state.tasks.push({
          id: this.$store.state.tasks.length + 1,
          title: this.inputText,
          completed: false,
        });

        this.inputText = "";
      }
    },
    downloadData() {
      // http://openlab.rf.gd/ToDoListVue/data.json
      axios.get('http://openlab.rf.gd/ToDoListVue/api/tasks_GET.php')
        .then((response) => {
          this.$store.state.tasks = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    uploadData() {
      // http://openlab.rf.gd/ToDoListVue/data.json
      // http://openlab.rf.gd/ToDoListVue/api/tasks_POST.php
      axios.post('http://openlab.rf.gd/ToDoListVue/api/tasks_POST.php', this.$store.state.tasks).then(response => {
        if (response.status == 200) {
          console.log("Data boli úspešne nahrané na server.");
        }
      }).catch(error => {
        console.log(error);
      });
    }
  },
  mounted() {
    this.downloadData();
  },
  computed: {
    activeTasksCount() {
      return this.$store.state.tasks.filter((task) => !task.completed).length;
    },
    deletedTasksCount() {
      return this.$store.state.tasks.filter((task) => task.completed).length;
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

.input-group {
    max-width: 600px;
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
