<template>
    <div class="app">
        <Nav></Nav>
        <router-view></router-view>
    </div>
</template>

<script>
import Nav from "./Loging/Nav";

export default {
    name: "App",

    components: {
        Nav
    },

    mounted() {
        this.isAuthenticatedUser();
    },
};
</script>

<style scoped></style>
