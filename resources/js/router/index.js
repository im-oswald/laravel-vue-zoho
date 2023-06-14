import { createRouter, createWebHistory } from 'vue-router';

import Form from '../components/form/Form.vue';

// TODO: Move the constants to env file
const ZOHO_CLIENT_ID = "1000.5L4YBDB7Y182AQ4UYLEB99J2Y003VT"
const ZOHO_SCOPES = "ZohoCRM.modules.deals.CREATE,ZohoCRM.modules.accounts.CREATE,ZohoCRM.modules.accounts.READ"
const REDIRECT_URI = "https://zoho.in.ngrok.io/api/auth/callback/"

const routes = [
  {
    path: '/create',
    name: 'create',
    component: Form
  },
  {
    path: '/auth/zoho/callback',
    name: 'auth.zoho.callback',
    component: {
      beforeRouteEnter(to, from, next) {
        window.location.href = `https://accounts.zoho.com/oauth/v2/auth?response_type=code&client_id=${ZOHO_CLIENT_ID}&scope=${ZOHO_SCOPES}&redirect_uri=${REDIRECT_URI}&access_type=offline`;
      },
      render: () => null
    }
  }
];

export default createRouter({ history: createWebHistory(), routes });
