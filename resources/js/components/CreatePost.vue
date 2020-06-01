<template>
  <div class="_container">
    <div class="admin-page-title">Create New Post</div>
      <span v-if="successful" class="badge badge-success">
        <h4>Save Successfully!</h4>
        <small>(Post baru berhasil dibuat dan dipublikasi!)</small>
      </span>
      <div class="_wrap-form">
        <form class="_bg-form">    
          <div class="form-group">
            <span v-if="errors.title" class="badge badge-danger">{{ errors.title[0] }}</span>     
            <input type="title" class="form-control" ref="title" id="title" placeholder="Title">
          </div> 
          <div class="form-group">
            <span v-if="errors.body" class="badge badge-danger">{{ errors.body[0] }}</span>     
            <textarea class="form-control" ref="body" id="body" placeholder="Body" rows="8"></textarea>
          </div>
          <button type="submit" @click.prevent="create" class="btn btn-primary">
            Submit
          </button>   
        </form><br><br><br>
      </div>
    </div>
</template>

<script>
export default {
    props: {
        userId: {
            type: Number,
            required: true
        }
    },
    data() {
      return {
        successful: false,
        errors: []
      }
    },
    methods: {
        create() {
            const formData = new FormData();
            formData.append('title', this.$refs.title.value);
            formData.append('body', this.$refs.body.value);
            formData.append('user_id', this.userId);

            axios.post('/api/posts', formData)
                .then(response => {
                    console.log(response.data);
                    this.errors = [0];
                    this.successful = true
                })
                .catch(error => {
                  console.log(error.response.data);
                  this.successful = false;
                  this.errors = error.response.data.errors;
                });
            
            this.$refs.title.value = '';
            this.$refs.body.value = '';
        }
    }
}
</script>