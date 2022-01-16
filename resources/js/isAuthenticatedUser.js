import store from "./store/index";

export default {
    methods: {
        isAuthenticatedUser() {
            if (store.getters.authenticated == null) {
                this.$router.push({ name: "Login" });
            }
        }
    }
};
