<template>
  <div class="container mt-3">
    <button class="storageStatus" :style="this.$store.state.useLocalStorage ? 'background-color: red' : 'background-color: green'" @click="showSecretInfo()" :title="this.$store.state.useLocalStorage ? 'Na ukladanie sa používa lokálne úložisko.' : 'Na ukladanie sa používa server.'"></button>
    <h1 class="text-center">ToDo List</h1>
    <div class="d-flex justify-content-center">
      <button class="btn btn-light me-1" @click="this.$store.commit('loadData')">
        <img src="../public/assets/download.svg" alt="Stiahni dáta zo serveru.">
      </button>
      <button class="btn btn-light ms-1" @click="this.$store.commit('saveData')">
        <img src="../public/assets/upload.svg" alt="Nahraj dáta na server.">
      </button>
    </div>
    <div class="input-group mt-3 mx-auto">
      <input type="text" class="form-control" v-model="this.$store.state.inputText" placeholder="Zadaj úlohu...">
      <button class="btn btn-outline-secondary" type="button" @click="this.emitter.emit('addTask')">Pridaj úlohu</button>
    </div>
    <div id="nav" class="d-flex justify-content-evenly border rounded-pill py-2 my-3 mx-auto">
      <router-link class="text-decoration-none" to="/active">Aktívne ({{ activeTasksCount }})</router-link>
      <router-link class="text-decoration-none" to="/deleted">Odstránené ({{ deletedTasksCount }})</router-link>
    </div>
  </div>
  <router-view />
</template>

<script>


export default {
  name: "App",
  methods: {
    showSecretInfo() {
      alert("- Červená, ak sa používa na ukladanie lokálne úložisko.\n- Zelená, ak sa používa na ukladanie server. \n\n- Pre ukladanie dát do lokálneho úložiska, napíš do 'inputu' pre úlohy '#localStorage'.\n- Pre ukladanie dát na server, napíš do 'inputu' pre úlohy '#server'.");
    }
  },
  mounted() {
    this.$store.commit('loadData');
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

.storageStatus {
  position: absolute;
  height: 10px;
  width: 10px;
  border: none;
  border-radius: 50%;
  display: inline-block;
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
