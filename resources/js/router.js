import Vue from "vue";
import VueRouter from "vue-router";
import DashBoard from "./components/DashBoard";
import Login from "./Loging/Login";
import Register from "./Loging/Register";
import Logout from "./Loging/logout";
import AddNewPost from "./components/AddNewPost";
import Profile from "./components/Profile";
import NotFounf from "./components/NotFound";
import ViewPost from "./components/post_components/_viewPost"
import EditPost from "./components/EditPost"

// import store from './store/index'

Vue.use(VueRouter);
export default new VueRouter({
    routes: [
        {
            name: "DashBoard",
            path: "/",
            component: DashBoard
        },
        {
            name: "Login",
            path: "/login",
            component: Login
        },
        {
            name: "Register",
            path: "/register",
            component: Register
        },
        {
            name: "DashBoard",
            path: "/dashBoard",
            component: DashBoard
            // beforeEnter: (to, from, next) => {
            //     if(!store.getters['authenticated']){
            //         return next({
            //             name: 'Login'
            //         })
            //     }
            // }
        },
        {
            name: "Logout",
            path: "/logout",
            component: Logout
        },
        {
            name: "addNewPost",
            path: "/add-new-post",
            component: AddNewPost
        },
        {
            name: "profile",
            path: "/profile/:id",
            component: Profile
        },
        {
            path: "/not-found",
            name: "404",
            component: NotFounf
        },
        {
            name: "viewPost",
            path: "/view-post/:postId",
            component: ViewPost
        },
        {
            name: "editPost",
            path: "/edit-post/:postId",
            component: EditPost
        },
    ],
    mode: "history"
});
