<template>
    <div>
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4"> 
        </div>
        <h2 id="titlepage">Blog</h2>
        <hr>
        <div class="row">
            <div class="form-group col-md-12">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
            </div>
        </div>      
        <hr>
        <div class="row">
            <div class="col-md-4" v-for="post in posts" :key="post.id" style="padding-bottom: 25px;">          
                <div class="card rounded-0 p-0 shadow-sm">
                    <img :src="'/images/' + post.image" class="card-img-top rounded-0" alt=""/>
                    <div class="card-body">
                        <h6 class="card-title"> {{post.title }}</h6>
                        <a href="#" target="_blank" class="btn btn-light btn-sm float-left"><i class="fa fa-share"></i></a> 
                        <button type="button" class="btn btn-secondary btn-sm float-right">
                            Read More..
                        </button> 
                    </div>
                </div>          
            </div>   
        </div>
    </div> 
</template> 

<script>
  export default{
    data: function(){
      return {
        posts: []
      }
    },
    created: function(){
      this.getPosts();
    },
    methods:{
      getPosts(){
        axios.get("/api/getHomepagePosts")
        .then(response => {
          console.log(response.data)
          this.posts = response.data;
        })
        .catch(error => {
          console.log(error.response.data)
        })
      }
    }
  }
</script>