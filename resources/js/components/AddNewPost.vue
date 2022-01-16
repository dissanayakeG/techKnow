<template>
    <div class="col-lg-10">
        <div class="container">
            <form>
                <div class="form-group">
                    <div class="form-group">
                        <label for="post-title">{{ ("Topic") }}</label>
                        <input
                            type="text"
                            class="form-control"
                            id="post-title"
                            v-model="topic"
                        />

                        <div class="text-danger" v-if="res_errors.topic">
                            <h6>{{ res_errors.topic[0] }}</h6>
                        </div>
                    </div>

                    <label for="post-tag">{{ ("Tag") }}</label>
                    <select
                        class="form-control"
                        id="post-tag"
                        v-model="tag"
                    >
                        <option :value="0" selected hidden>{{ ("select a tag") }}</option>
                        <option
                            v-for="option in option_array"
                            :value="option"
                            :key="option.id"
                        >
                            {{ option["name"] }}
                        </option>
                    </select>
                    <div class="text-danger" v-if="res_errors.tag">
                        <h6>{{ res_errors.tag[0] }}</h6>
                    </div>
                </div>

                <div class="form-group">
                    <label for="post-content">{{ ("Content") }}</label>
                    <textarea
                        class="form-control"
                        id="post-content"
                        rows="5"
                        v-model="content"
                    ></textarea>
                    <div class="text-danger" v-if="res_errors.post_content">
                        <h6>{{ res_errors.post_content[0] }}</h6>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-info" @click="submit">
                {{ ("Submit") }}
            </button>
        </div>
    </div>
</template>

<script>
import store from "../store/index";

export default {
    data() {
        return {
            option_array: [
                {id: 1, name: "js"},
                {id: 2, name: "php"},
                {id: 3, name: "jQuery"},
                {id: 4, name: "json"},
                {id: 5, name: "laravel"}
            ],
            tag: "",
            content: "",
            topic: "",
            user: store.getters.user,
            res_errors: {}
        };
    },

    methods: {
        submit() {
            let save_data = {
                user_id: this.user.id,
                topic: this.topic,
                tag: this.tag.id,
                post_content: this.content
            };

            axios.post("api/add-new-post", save_data).then(response => {
                if (response.data.data && response.data.data.errors) {
                    this.res_errors = response.data.data.errors.validations;
                } else {
                    this.$router.push({path: "dashboard"});
                }
            });
        }
    }
};
</script>

<style></style>
