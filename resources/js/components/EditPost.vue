<template>
  <div class="_container">
    <div class="admin-page-title">Edit Post</div>
      <span v-if="successful" class="label label-success"> 
        <h4>Updated!</h4> 
        <small>(Post berhasil diperbaharui!)</small> 
      </span> 
      <div class="_wrap-form">
        <form class="_bg-form">    
          <div class="form-group">
            <span v-if="errors.title" class="badge badge-danger">{{ errors.title[0] }}</span>     
            <input type="text" class="form-control" v-model="title" ref="title" id="title" placeholder="Title">
          </div> 
          <div class="form-group">
            <span v-if="errors.category_id" class="badge badge-danger">{{ errors.category_id[0] }}</span>     
            <select class="form-control" v-model="old_category" ref="category_id">
              <option value="">Select Category</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <span v-if="errors.body" class="badge badge-danger">{{ errors.body[0] }}</span>     
            <textarea class="form-control" v-model="body" ref="body" id="body" placeholder="Body" rows="8"></textarea>
          </div>
          <div class="form-group" v-if="image">
              <div class="col-4">
                  <img :src="'/images/' + image" style="width: 100%">
              </div>
          </div>
          <div class="form-group">
            <span v-if="errors.image" class="badge badge-danger">{{ errors.image[0] }}</span>     
            <div class="custom-file mb-3">
              <input type="file" ref="image" id="image" class="custom-file-input" required>
              <label for="image" class="custom-file-label">Choose file</label>
            </div>
          </div>
          <button type="submit" @click.prevent="updatePost" class="btn btn-primary">
            Submit
          </button>   
        </form><br><br><br>
      </div>
    </div>
</template>

<script>
export default {
    props: {
        postId: {
            type: Number,
            required: true
        }
    },
    data() {
      return {
        successful: false, 
        errors: [],
        categories: [],
        title: '',
        body: '',
        image: '',
        old_category: ''
      }
    },
    created:function() {
      this.getCategories();
      this.getPosts();
    },
    methods: {
        updatePost() {
            const formData = new FormData();
            formData.append('title', this.$refs.title.value);
            formData.append('body', this.$refs.body.value);
            formData.append('image', this.$refs.image.files[0]);
            formData.append('category_id', this.$refs.category_id.value);
            formData.append('_method', 'PUT');

            axios.post('/api/posts/' + this.postId, formData)
                .then(response => {
                    console.log(response.data);
                    this.errors = false;
                    this.successful = true
                })
                .catch(error => {
                    if((error.response.status == 422)) {
                        console.log(error.response.data);
                        this.successful = false; 
                        this.errors = error.response.data.errors;
                    }
                });
        },
        // MENAMPILKAN DATA YANG INGIN DIEDIT
        getPosts() {
          axios.get('/api/posts/' + this.postId + '/edit')
            .then(response => {
              console.log(response.data);
              this.title = response.data.title;
              this.body = response.data.body;
              this.image = response.data.image;
              this.old_category = response.data.category_id;
            });
        },
        // MENAMPILKAN SEMUA DATA KATEGORI
        getCategories() {
          axios.get('/api/getCategories')
            .then(response => {
              console.log(response.data);
              this.categories = response.data;
            });
        }
    }
}
</script>

<style scoped>
  .label-success {
    background-color: #4fca6b;
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