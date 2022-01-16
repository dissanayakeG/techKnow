<template>
    <div class="container">
        <h4>{{post.topic}}</h4>
        <p class="content-section">
            {{post.post_content}}
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {}
        }
    },
    mounted() {
        this.getPostById();
    },

    methods: {
        getPostById() {
            axios.get('/api/get-post-by-id/' + this.$route.params.postId).then(response => {
                if (response.data) {
                    this.post = response.data[0];
                }
            });

        }
    }
}
</script>
