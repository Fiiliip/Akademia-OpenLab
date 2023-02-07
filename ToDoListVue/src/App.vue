<template>
  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center fs-2 mt-3">ToDo List</h1>
      <div id="nav" class="d-flex col-sm-4 justify-content-evenly border rounded-pill border-danger py-2 mt-3 mx-5">
        <router-link class="text-decoration-none" to="/active">Aktívne</router-link>
        <router-link class="text-decoration-none" to="/deleted">Odstránené</router-link>
      </div>
    </div>
  </div>
  <router-view />
</template>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;

    font-family: Avenir, Helvetica, Arial, sans-serif;
    letter-spacing: 1px;

    -ms-overflow-style: none;
}

* ::-webkit-scrollbar {
    display: none;
}

#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
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
