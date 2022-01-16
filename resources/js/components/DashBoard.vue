<template>
    <div class="col-lg-12 dashboard-body">
        <h4 class="main-heading">
            <strong>{{ ("TechKnow") }}</strong>
        </h4>

        <span></span>
        <div v-for="post in posts" :key="post.id">
            <postComponent :post="post" :isProfile="false" @deletePost="deletePost"/>
        </div>
    </div>
</template>

<script>
import postComponent from "./post_components/_post";

export default {
    data() {
        return {
            user: {},
            posts: []
        };
    },
    components: {
        postComponent
    },
    mounted() {
        this.getAllPosts();
    },

    methods: {
        deletePost(){
            this.getAllPosts();
        },

        getAllPosts() {
            axios.get("/api/get-all-posts").then(response => {
                console.log(response.data, response);
                if (response.data) {
                    this.posts = response.data;
                }
            });
        }
    }
};
</script>

<style></style>
