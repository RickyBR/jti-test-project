import { createRouter, createWebHistory } from "vue-router";

import InputData from '../views/InputData.vue';
import ListData from '../views/ListData.vue';

const routes = [
    {path: '/input-data', component: InputData},
    {path: '/list', component: ListData}, 
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;