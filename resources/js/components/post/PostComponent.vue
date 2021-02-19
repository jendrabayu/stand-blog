<template>
  <div class="card">
    <div class="card-header">
      <h4>All posts</h4>
      <div class="card-header-action">
        <a :href="createPostLink" class="btn btn-primary">Create new post</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table table-responsive">
        <table class="table table-bordered table-md">
          <thead>
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Tag</th>
              <th>Author</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
              <td>{{ index + 1 }}</td>
              <td><img :src="post.image" width="70" /></td>
              <td>{{ post.title }}</td>
              <td>
                <span class="badge badge-info">{{ post.category }}</span>
              </td>
              <td>
                <span
                  class="badge badge-primary m-1"
                  v-for="tag in post.tags"
                  :key="tag.id"
                  >{{ tag.title }}</span
                >
              </td>
              <td>{{ post.author }}</td>
              <td>{{ post.status }}</td>
              <td>
                <div
                  class="btn-group mb-3"
                  role="group"
                  aria-label="Basic example"
                >
                  <button class="btn btn-icon btn-info">
                    <i class="fas fa-eye"></i>
                  </button>
                  <a :href="post.link_edit" class="btn btn-icon btn-warning">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <button
                    @click="destroy(post.id)"
                    class="btn btn-icon btn-danger"
                  >
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </div>
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
  props: {
    createPostLink: {
      type: String,
      required: true,
    },
  },
  created() {
    this.getPosts();
  },
  data() {
    return {
      posts: [],
    };
  },
  methods: {
    getPosts() {
      axios
        .get("/admin/posts")
        .then((response) => {
          this.posts = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    destroy(id) {
      axios
        .delete(`/admin/post/${id}`)
        .then((response) => {
          console.log(response.data);
          this.getPosts();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>