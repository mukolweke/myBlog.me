<script>

    export default {
        data() {
            return {
                posts: [],
                post: {
                    id: 0,
                    title: '',
                    body: '',
                    user_id: '',
                    cover_image: '',
                    created_at: '',
                    deleted_at: ''
                }
            }
        },

        methods: {

            // used to get data from api call
            getBlogs() {
                axios.get('/api/blogs').then(response => {

                    this.posts = response.data

                });
            }
        },

        mounted() {

            this.getBlogs();

        }


    }
</script>

<template>

    <div>

        <h1>Posts</h1>

        <div v-if="posts.length > 0 ">
            <div class="well" v-for="post in posts">
                <div class="row">
                    <div class="col-md-4  col-sm-4">
                        <img style="width: 100%" :src="'/storage/cover_images/'+post.cover_image">
                    </div>
                    <div class="col-md-8  col-sm-8">
                        <h3><a :href="'/posts/'+post.id">{{post.title}}</a></h3>
                        <small>Written on {{post.created_at}} by kuku</small>
                    </div>
                </div>

            </div>
        </div>

        <div v-else>
            <p>No Posts Found</p>
        </div>

    </div>

</template>
