<template>
  <div class="container mt-3">
    <h1 class="text-center">ToDo List</h1>
    <div style="max-width: 600px" class="input-group mt-3 mx-auto">
      <input type="text" class="form-control" v-model="inputText" placeholder="Zadaj úlohu...">
      <button class="btn btn-outline-secondary" type="button" @click="addTask()">Pridaj úlohu</button>
    </div>
    <div id="nav" style="max-width: 335px" class="d-flex justify-content-evenly border rounded-pill py-2 my-3 mx-auto">
      <router-link class="text-decoration-none" to="/active">Aktívne</router-link>
      <router-link class="text-decoration-none" to="/deleted">Odstránené</router-link>
    </div>
  </div>
  <router-view />
</template>

<script>
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
          isDone: false,
        });

        this.inputText = "";
      }
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
  a {
    color: #2c3e50;
    
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
