<template>
    <div class="col-lg-12 dashboard-body">
        <h4 class="main-heading">
            <strong>{{ ("TechKnow") }}</strong>
        </h4>

        <span></span>
        <div v-for="post in posts" :key="post.id">
            <postComponent :post="post" :isProfile="true" @deletePost="deletePost"/>
        </div>
    </div>
</template>

<script>
import postComponent from "./post_components/_post";

export default {
    data() {
        return {
            posts: []
        };
    },
    components: {
        postComponent
    },
    mounted() {
        this.getAllPostsByUserId();
    },

    methods: {
        deletePost(){
            this.getAllPostsByUserId();
        },

        getAllPostsByUserId() {
            axios
                .get("/api/get-all-posts-by-user/" + this.$route.params.id)
                .then(res => {
                    this.posts = res.data;
                });
        }
    }
};
</script>

<style></style>
