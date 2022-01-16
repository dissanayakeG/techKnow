<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div
                class="collapse navbar-collapse justify-content-end"
                id="navbarNav"
            >
                <ul class="navbar-nav">
                    <template v-if="authenticated">
                        <li
                            class="nav-item active"
                            v-if="this.$route.name != 'DashBoard'"
                        >
                            <router-link
                                class="nav-link"
                                :to="{ path: '/dashBoard' }"
                                >DashBoard
                            </router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link
                                class="nav-link"
                                :to="{ path: '/profile/' + user.id }"
                                >{{ user.name }}
                            </router-link>
                        </li>
                        <li class="nav-item active">
                            <a
                                href="#"
                                class="nav-link"
                                @click.prevent="signOut"
                                >Logout</a
                            >
                        </li>
                        <li class="nav-item active">
                            <router-link
                                class="nav-link"
                                :to="{ path: '/add-new-post' }"
                                >Create New Article
                            </router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item active">
                            <router-link class="nav-link" to="/login"
                                >Login</router-link
                            >
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" to="/register"
                                >Register</router-link
                            >
                        </li>
                    </template>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            authenticated: "authenticated",
            user: "user"
        })
    },

    methods: {
        ...mapActions({
            signOutAction: "signOut"
        }),
        signOut() {
            this.signOutAction().then(() => {
                this.$router.replace({
                    name: "Login"
                });
            });
        }
    }
};
</script>
