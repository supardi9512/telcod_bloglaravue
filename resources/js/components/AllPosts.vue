<template>
    <div>
        <div class="_container">
            <div class="admin-page-title">All Posts</div>
            <div class="h_wrap">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Categories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-for="post in posts" :key="post.id">
                        <tr>
                            <td style="width: 450px;">{{ post.title }}</td>
                            <td style="width: 250px;">
                                <span v-if="post.image"><img :src="'/images/'+post.image" alt=""></span>
                            </td>
                            <td>
                                <span v-if="post.category">{{ post.category.name }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-block btn-primary">Edit</button>
                                <button type="button" class="btn btn-block btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            posts: []
        }
    },
    created: function() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios.get('/api/posts')
                .then(response => {
                    console.log(response.data);
                    this.posts = response.data.data;
                });
        }
    }
}
</script>

<style scoped>
    tbody img {
        width: 100%;
    }

    .table-bordered {
        background-color: #ffffff;
    }
</style>