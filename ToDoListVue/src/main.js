import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from './store';

import moxios from '@/plugins/w/axios-mocks'

moxios.mock({})
moxios.mock({
	'GET data': true,
  'POST data': true,
})

const app = createApp(App)
  .use(store)
  .use(router)

app.mount("#app");
