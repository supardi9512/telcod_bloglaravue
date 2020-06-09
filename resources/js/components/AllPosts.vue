<template>
    <div>
        <div class="_container">
            <div class="admin-page-title">All Posts</div>
            <span v-if="successful" class="label label-success"> 
                <h4>Deleted!</h4> 
                <small>(Post berhasil dihapus!)</small> 
            </span> 
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
                                <router-link :to="{ name: 'editpost', params: {postId: post.id} }">
                                    <button type="button" class="btn btn-block btn-primary">Edit</button>
                                </router-link>
                                <button type="button" @click="deletePost(post.id)" class="btn btn-block btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getPosts()"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import pagination from './Pagination.vue'

export default {
    components: {
        pagination
    },
    data: function() {
        return {
            posts: [],
            successful: false,
            pagination: {
                'current_page': 1
            }
        }
    },
    created: function() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios.get('/api/posts?page=' + this.pagination.current_page)
                .then(response => {
                    console.log(response.data);
                    this.posts = response.data.data.data;
                    this.pagination = response.data.pagination;
                });
        },
        deletePost(id) {
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                axios.delete('/api/posts/' + id)
                    .then(response => {
                        console.log('deleted!');
                        this.getPosts();
                        this.successful = true;
                    })
            }
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

    .label-success {
        background-color: #dc3545;
        display: inline-block;
        width: 100%;
        color: #fff;
        padding: 8px 15px;
        margin-bottom: 8px;
    }

    .label-success h4 {
        margin-bottom: 0;
    }
</style>