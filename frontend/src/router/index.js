import {createRouter, createWebHistory} from 'vue-router'
import EditTask from "../components/EditTask.vue";
import MainBoard from "../views/MainBoard.vue";
import Home from "../views/Home.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: 'Home',
            path: '/boards',
            component: Home
        },
        {
            name: 'Board',
            path: '/boards/:projectId',
            component: MainBoard,
            children: [
                {
                    name: 'EditTask',
                    path: ':taskId/edit-task',
                    component: EditTask
                }
            ]
        }
    ]
})

export default router
