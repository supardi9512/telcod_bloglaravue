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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            successful: false
        }
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
                .then(response => {
                    console.log(response.data);
                    this.categories = response.data;
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