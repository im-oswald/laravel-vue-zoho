import { createRouter, createWebHistory } from 'vue-router';

import Form from '../components/form/Form.vue';

const routes = [
  {
    path: '/create',
    name: 'create',
    component: Form
  },
];

export default createRouter({ history: createWebHistory(), routes });
