

<template>
    <div>
        <h1>Create Post</h1>

        <form class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">Title: </label>
                <div class="col-sm-10">
                    <input type="text" v-model="title" placeholder="Enter Title" name="title" id="title" class="form-control">
                </div>
            </div>

             <div class="form-group">
                <label for="txtbody" class="control-label col-sm-2">Body: </label>
                <div class="col-sm-10">
                    <textarea name="body" v-model="body" id="txtbody" cols="30" rows="10" placeholder="Blog Body" class="form-control"></textarea>
                </div>
            </div>
            <!--<div class="form-group">-->
            <!--<div class="col-sm-2 clearfix"></div>-->
                <!--<div class="col-sm-10">-->
                    <!--<input type="file" name="cover_image" v-model="cover_image"/>-->
                <!--</div>-->
            <!--</div>-->
            <div class="form-group">
            <div class="col-sm-2 clearfix"></div>
                <div class="col-sm-10">
                    <button type="submit" @click="addNewBlogPost()" class="btn btn-primary">Post Blog</button>
                </div>
            </div>

        </form>

        <!---->
    </div>
</template>

<script>
    export default {
        name: "PostBlogView",

        data(){

            return{

                title: '',
                body: '',
                cover_image:'',

            }
        },

        methods: {

            addNewBlogPost(){
                console.log(this.title)
                // posting data to API

                axios.post('/api/blogs',{

                    title: this.title,
                    body: this.body,
                    cover_image: this.cover_image

                }).then(response => {
                    console.log(response)

                    this.title = '';
                    this.body = '';

                }).catch(error => {

                    console.log(error)

                })
            }

        },


    }
</script>