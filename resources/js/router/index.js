import { createRouter, createWebHistory } from 'vue-router';

import DealForm from '../components/deal/DealForm.vue';
import AccountForm from '../components/account/AccountForm.vue';

const routes = [
  {
    path: '/deals/create',
    name: 'deals.create',
    component: DealForm
  },
  {
    path: '/accounts/create',
    name: 'accounts.create',
    component: AccountForm
  },
];

export default createRouter({ history: createWebHistory(), routes });
