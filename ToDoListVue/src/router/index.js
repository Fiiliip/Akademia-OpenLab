import { createRouter, createWebHistory } from "vue-router";

// import ActiveTasks from '@/plugins/app/active-tasks/active-tasks.vue'; // Načíta na začiatku aplikácie, resp. nepoužíva lazy-loading.

const routes = [
  {
    path: "/",
    redirect: "/active",
  },
  {
    path: "/active",
    name: "active-tasks",
    // component: ActiveTasks // Keby som používal import zo začiatku tohto súboru. Nevyužíva lazy-loading.
    component: () => import('@/plugins/app/active-tasks/active-tasks.vue'), // Route level code-splitting. This generates a separate chunk (about.[hash].js) for this route which is lazy-loaded when the route is visited.
  },
  {
    path: "/deleted",
    name: "deleted-tasks",
    component: () => import('@/plugins/app/deleted-tasks/deleted-tasks.vue'),
  },
  {
    path: "/edit/:id",
    name: "edit-task",
    component: () => import('@/plugins/app/edit-task/edit-task.vue'),
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
