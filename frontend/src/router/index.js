import Vue from "vue";
import Router from "vue-router";
import Homepage from "../components/Homepage.vue";
import Articles from "../components/Articles.vue";
import ErrorPage from "../components/Error.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/articles/page/:num",
      name: "Articles",
      component: Articles,
      props: true
    },
    {
      path: "/",
      name: "Homepage",
      component: Homepage,
      props: true
    },
    {
      path: "*",
      name: "ErrorPage",
      component: ErrorPage
    }
  ]
});