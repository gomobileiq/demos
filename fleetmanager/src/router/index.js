import Vue from "vue";
import VueRouter from "vue-router";
import Main from "../components/pages/Main";
import routerHooks from "./router-hooks";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "main",
    component: () => import("@pages/Main.vue"),
    children: [
      {
        path: "",
        name: "main",
        component: () => import("@organisms/OMain.vue")
      },
    ]
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../components/templates/Login.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

routerHooks(router);

export default router;
