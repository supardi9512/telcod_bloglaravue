<template>
    <div>
        <div class="_container">
            <div class="admin-page-title">All Categories</div>
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
    data() {
        return {
            categories: []
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
        }
    }
}
</script>

<style scoped>
    .table-bordered {
        background-color: #ffffff;
    }
</style>