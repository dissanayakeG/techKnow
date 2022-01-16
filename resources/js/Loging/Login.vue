<template>
    <div class="container">
        <div class="sidenav">
            <div class="login-main-text">
                <h2>
                    TechKnow<br />
                    Hi! Nice Day!!!
                </h2>
                <p>Login from here to access.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <form>
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="username"
                                placeholder="Email"
                                v-model="email"
                            />

                            <div class="text-danger" v-if="res_errors.email">
                                <h6>{{ res_errors.email[0] }}</h6>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="Password"
                                v-model="password"
                            />

                            <div class="text-danger" v-if="res_errors.password">
                                <h6>{{ res_errors.password[0] }}</h6>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-danger" v-if="res_errors">
                                <h6>{{ res_errors.user_name }}</h6>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-black"
                            @click.prevent="submit()"
                        >
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "../store/index";

export default {
    data() {
        return {
            email: "",
            password: ""
        };
    },

    mounted() {},

    computed: {
        ...mapGetters({
            res_errors: "login_errors"
        })
    },

    methods: {
        ...mapActions({
            signIn: "signIn"
        }),

        submit() {
            let save_data = {
                email: this.email,
                password: this.password
            };
            this.signIn(save_data).then(() => {
                if (!store.getters.login_errors) {
                    this.$router.push({ path: "/dashBoard" });
                }
            });
        }
    }
};
</script>

<style scoped>
body {
    font-family: "Lato", sans-serif;
}

.main-head {
    height: 150px;
    background: #fff;
}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
    margin-top: 56px;
}

.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {
        padding-top: 15px;
    }
}

@media screen and (max-width: 450px) {
    .login-form {
        margin-top: 10%;
    }

    .register-form {
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px) {
    .main {
        margin-left: 40%;
    }

    .sidenav {
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form {
        margin-top: 80%;
    }

    .register-form {
        margin-top: 20%;
    }
}

.login-main-text {
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2 {
    font-weight: 300;
}

.btn-black {
    background-color: #000 !important;
    color: #fff;
}
</style>
