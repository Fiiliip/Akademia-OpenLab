import { createApp } from "vue";
import mitt from 'mitt'
import App from "./App.vue";
import router from "./router";
import store from './store';

const emitter = mitt()

const app = createApp(App)
  .use(store)
  .use(router)

app.mount("#app");

app.config.globalProperties.emitter = emitter;

emitter.on('addTask', () => {
  store.commit('addTask')
});
