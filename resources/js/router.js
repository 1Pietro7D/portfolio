import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import ProjectDetail from "./vue/components/ProjectDetail.vue"
import Projects from "./vue/components/ProjectsCarousel.vue"

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home', alias: ['/home', '/portfolio'],
            component: Projects
        },
        {
            path: '/project',  //:slug
            name: 'project',
            component: ProjectDetail
        },
        {
            path: '*',
            name: "404",
            component: () => import('./vue/components/NotFound.vue')
        }
    ]
});

export default router;
