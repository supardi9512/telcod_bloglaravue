<template>
    <div>
        <div class="_container">
            <div class="admin-page-title">All Categories</div>
            <span v-if="successful" class="label label-success"> 
                <h4>Deleted!</h4> 
                <small>(Kategori berhasil dihapus!)</small> 
            </span> 
            <div class="h_wrap">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-for="category in categories" :key="category.id">
                        <tr>
                            <td style="width: 600px;">{{ category.name }}</td>
                            <td class="text-center">
                                <router-link :to="{name: 'editcategory', params: {categoryId: category.id}}">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </router-link>
                                <button type="button" @click="deleteCategory(category.id)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getCategories()"></pagination>
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
    data() {
        return {
            categories: [],
            successful: false,
            pagination: {
                'current_page': 1
            }
        }
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios.get('/api/categories?page=' + this.pagination.current_page)
                .then(response => {
                    console.log(response.data);
                    this.categories = response.data.data.data;
                    this.pagination = response.data.pagination;
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        deleteCategory(id) {
            if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                axios.delete('/api/categories/' + id)
                    .then(response => {
                        console.log('deleted!');
                        this.getCategories();
                        this.successful = true;
                    })
            }
        }
    }
}
</script>

<style scoped>
    .table-bordered {
        background-color: #ffffff;
    }

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