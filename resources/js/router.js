import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import ProjectDetail from "./vue/components/ProjectDetail.vue"
import Projects from "./vue/components/Carousel3D.vue"

const router = new VueRouter({

    // mode: 'history',
    routes: [

        {
            path: '/project/:slug',
            name: 'project',
            component: ProjectDetail
        },
        {
            path: '/project/*',
            name: "404",
            component: () => import('./vue/components/NotFound.vue')
        }, {
            path: '/',
            name: 'home', //alias: ['/home', '/portfolio'],
            component: Projects,

        }
    ]
});

export default router;
