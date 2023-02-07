import { createRouter, createWebHashHistory } from "vue-router";
import ActiveTasks from "../views/ActiveTasks.vue";

const routes = [
  {
    path: "/active",
    name: "ActiveTasks",
    component: ActiveTasks,
  },
  {
    path: "/deleted",
    name: "DeletedTasks",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/DeletedTasks.vue"),
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
