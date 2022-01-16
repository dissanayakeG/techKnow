<template>
    <div class="row">
        <div class="container post">
            <div class="header-section">
                <div class="topic">
                    <h3>{{ post.topic }}</h3>
                    <h5 class="ml-2"> {{ (" by ") }}{{ post.user.name }}</h5>
                </div>
                <div class="menu">
                    <div class="dropdown dropleft">
                        <a href="#" data-toggle="dropdown"><strong>...</strong></a>
                        <div class="dropdown-menu">
                            <router-link
                                :to="{ name: 'viewPost', params: { postId: post.id } }"
                                class="dropdown-item"
                            >{{ "Read full article" }}
                            </router-link>
                            <router-link
                                v-if="isProfile"
                                :to="{ name: 'editPost', params: { postId: post.id } }"
                                class="dropdown-item"
                            >{{ "Edit Post" }}
                            </router-link>
                            <a v-if="isProfile" href="#" class="dropdown-item" @click.prevent="deletePost(post.id)">
                                {{ "Delete Post" }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="post-body">
                <p class="content-section">{{ post.post_content }}</p>
            </div>

            <div class="react-section">
                <p>
                    <span v-if="post.likes > 0" class="m-2">{{ ("+") }}{{ post.likes > 0 ? post.likes : '' }}</span>
                    <button type="button" class="btn btn-outline-light"
                            @click="checkIfUserHasReactedPost(post.id, 'like')"
                            :disabled="isEnableReactionButtons('like', post.user_id)">
                        <i class="fas fa-angle-up"></i>
                    </button>
                </p>
                <p>
                    <button type="button" class="btn btn-outline-light"
                            @click="checkIfUserHasReactedPost(post.id, 'dislike')"
                            :disabled="isEnableReactionButtons('dislike', post.user_id)">
                        <i class="fas fa-angle-down"></i>
                    </button>
                    <span v-if="post.dislikes > 0" class="m-2">{{ ("-") }}{{
                            post.dislikes > 0 ? post.dislikes : ''
                        }}</span>
                </p>
                <p><span v-if="react" class="">you already reacted this post!</span></p>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            react: '',
        }
    },
    props: {
        post: {
            type: Object
        },
        isProfile: {
            type: Boolean
        }
    },

    computed: {
        ...mapGetters({
            user: "user"
        })
    },

    methods: {
        isEnableReactionButtons(reaction, userId) {
            if (this.react == reaction || this.isProfile == true || userId == this.user.id) {
                return true;
            } else {
                return false;
            }
        },

        deletePost(id) {
            axios.post("/api/delete-post/" + id).then(response => {
                this.$emit('deletePost', true);
            });
        },

        checkIfUserHasReactedPost(postId, react) {
            axios.post("/api/check-is-user-reacted-post/" + postId, {userId: this.user.id}).then(response => {
                if (response.data) {
                    //console.log(Object.keys(response.data).length === 0, response.data);
                    this.react = response.data.reaction;
                    if (this.react != react || Object.keys(response.data).length === 0) {
                        this.reactPost(postId, react);
                    }
                }
            });
        },

        reactPost(postId, react) {
            axios.post("/api/react-post/" + postId, {react: react, userId: this.user.id}).then(response => {
                console.log(response.data);
            });
        },

    }
};
</script>

<style>

</style>
