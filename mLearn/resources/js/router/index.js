import { createWebHistory, createRouter } from 'vue-router';


const Home = () => import('../components/home.vue');
const UserList = () => import('../components/user/user-list.vue');
const UserForm = () => import('../components/user/user-form.vue');

const routes = [
    {
        name: "Home",
        path: "/",
        component: Home,
    },
    {
        name: "user-list",
        path: "/user/",
        component: UserList,
        children: [
            {
                name: "user-form",
                path: "/user/create",
                component: UserForm,
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
})
export default router