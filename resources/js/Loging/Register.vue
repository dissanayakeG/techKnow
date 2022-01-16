<template>
    <div class="container">
        <div class="sidenav">
            <div class="login-main-text">
                <h2>
                    TechKnow<br />
                    Hi! Nice Day!!!
                </h2>
                <p>register from here to access.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    <form>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                placeholder="User Name"
                                v-model="username"
                            />

                            <div class="text-danger" v-if="res_errors.name">
                                <h6>{{ res_errors.name[0] }}</h6>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                placeholder="Email"
                                v-model="email"
                            />

                            <div class="text-danger" v-if="res_errors.email">
                                <h6>{{ res_errors.email[0] }}</h6>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                placeholder="Password"
                                v-model="password"
                            />

                            <div class="text-danger" v-if="res_errors.password">
                                <h6>{{ res_errors.password[0] }}</h6>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password2">Confirm password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password2"
                                placeholder="Confirm Password"
                                v-model="confirm_password"
                            />

                            <div
                                class="text-danger"
                                v-if="res_errors.confirm_password"
                            >
                                <h6>{{ res_errors.confirm_password[0] }}</h6>
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-black"
                            @click.prevent="submit()"
                        >
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: "",
            email: "",
            password: "",
            confirm_password: "",
            res_errors: []
        };
    },
    mounted() {},

    methods: {
        submit() {
            let save_data = {
                name: this.username,
                email: this.email,
                password: this.password,
                confirm_password: this.confirm_password
            };
            axios.post("api/auth/register", save_data).then(response => {
                if (response.data.data) {
                    if (!response.data.data.errors) {
                        this.$router.push({ path: "login" });
                    } else {
                        this.res_errors = response.data.data.errors.validations;
                    }
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
