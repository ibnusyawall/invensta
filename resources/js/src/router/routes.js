
import Admin from './admin'
import Operator from './operator'
import Pegawai from './pegawai'

import DashboardLayout from "./../layout/dashboard/DashboardLayout.vue";
import NotFound from "./../pages/NotFoundPage.vue";

const Login = () => import(/* webpackChunkName: "common" */ "./../pages/Auth/Login.vue");
const LoginPegawai = () => import(/* webpackChunkName: "common" */ "./../pages/Auth/Pegawai/Login.vue");

const routes = [
    {
          name: 'login',
          path: '/login',
          component: Login,
          meta: { guest: true }
    },
    {
          name: 'login-pegawai',
          path: '/pegawai/login',
          component: LoginPegawai,
          meta: { guest: true }
    },
    {
          path: '/home',
          component: DashboardLayout,
          children: [
              ...Admin,
              ...Operator,
              ...Pegawai
          ],
          meta: { requireAuth: true }
    },
    {
          path: "*",
          component: NotFound
    },
];


export default routes;
