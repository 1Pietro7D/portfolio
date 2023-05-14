import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// import ProjectDetail from "./components/ProjectDetail.vue"
// import PortfolioComponent from "./components/PortfolioComponent.vue"

const router = new VueRouter({
    mode: 'history',
    routes: [
        //     {
        //         path: '/',
        //         name: 'home', alias: ['/home', '/portfolio'],
        //         component: PortfolioComponent
        //     },
        //     {
        //         path: '/project/:slug',
        //         name: 'project',
        //         component: ProjectDetail
        //     },
        //     {
        //         path: '*',
        //         name: "404",
        //         component: () => import('./components/notFound.vue')
        //     }
    ]
});

export default router;
