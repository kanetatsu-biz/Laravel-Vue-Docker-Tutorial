import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../views/HomePage.vue';
import TaskPage from '../views/TaskPage.vue';

const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: HomePage,
  },
  {
    path: '/tasks',
    name: 'TaskPage',
    component: TaskPage,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
