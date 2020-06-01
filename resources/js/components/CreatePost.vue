<template>
  <div class="_container">
    <div class="admin-page-title">Create New Post</div>
      <div class="_wrap-form">
        <form class="_bg-form">         
          <div class="form-group">
            <input type="title" class="form-control" ref="title" id="title" placeholder="Title">
          </div> 
          <div class="form-group">
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
    methods: {
        create() {
            const formData = new FormData();
            formData.append('title', this.$refs.title.value);
            formData.append('body', this.$refs.body.value);
            formData.append('user_id', this.userId);

            axios.post('/api/posts', formData)
                .then(response => {
                    console.log(response.data);
                });
            
            this.$refs.title.value = '';
            this.$refs.body.value = '';
        }
    }
}
</script>