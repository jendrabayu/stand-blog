<template>
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>All Categories</h4>
          <div class="card-header-action">
            <button class="btn btn-primary" @click="showCreateForm()">
              Add <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Posts</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <transition-group
                tag="tbody"
                name="fade"
                enter-active-class="animate__animated animate__fadeInUp"
                leave-active-class="animate__animated animate__fadeOutDown"
              >
                <tr v-for="(category, index) in categories" :key="category.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ category.title }}</td>
                  <td>{{ category.posts_count }}</td>
                  <td>{{ dateFormat(category.created_at) }}</td>
                  <td>{{ dateFormat(category.updated_at) }}</td>
                  <td>
                    <button
                      @click="edit(category)"
                      class="btn btn-icon btn-warning"
                    >
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                      @click="destroy(category.id)"
                      class="btn btn-icon btn-danger"
                    >
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>
              </transition-group>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal create category -->
    <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      id="modal-add-category"
      data-backdrop="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new category</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="createForm.title"
                  :disabled="loading.store"
                />
              </div>
              <div class="form-group mb-0">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="store()"
                  :disabled="
                    createForm.title.trim('').length === 0 || loading.store
                  "
                >
                  {{ loading.store ? "Loading..." : "Save" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit Category -->
    <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      id="modal-edit-category"
      data-backdrop="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new category</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Name</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="editForm.title"
                  :disabled="loading.update"
                />
              </div>
              <div class="form-group mb-0">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="update()"
                  :disabled="
                    editForm.title.trim('').length === 0 || loading.update
                  "
                >
                  {{ loading.update ? "Loading..." : "Update" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      createForm: {
        errors: [],
        title: "",
      },
      editForm: {
        errors: [],
        id: null,
        title: "",
      },
      loading: {
        store: false,
        delete: false,
        update: false,
      },
    };
  },
  created() {
    this.getCategories();
  },
  methods: {
    getCategories() {
      axios
        .get("/admin/categories")
        .then((response) => {
          this.categories = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    showCreateForm() {
      $("#modal-add-category").modal("show");
    },
    edit(category) {
      $("#modal-edit-category").modal("show");
      this.editForm.id = category.id;
      this.editForm.title = category.title;
    },
    store() {
      this.loading.store = true;
      axios
        .post("/admin/category", { title: this.createForm.title })
        .then((response) => {
          this.categories.unshift(response.data);
          this.loading.store = false;
          $("#modal-add-category").modal("hide");
          this.createForm.title = "";
        })
        .catch((error) => {
          console.log(error.response);
          this.loading.store = false;
          $("#modal-add-category").modal("hide");
          this.createForm.title = "";
        });
    },
    update() {
      this.loading.update = true;
      axios
        .put(`/admin/category/${this.editForm.id}`, {
          title: this.editForm.title,
        })
        .then((response) => {
          const data = response.data;
          this.loading.update = false;
          $("#modal-edit-category").modal("hide");
          const index = this.categories.findIndex((cat) => cat.id === data.id);
          this.categories.splice(index, 1, data);
        })
        .catch((error) => {
          console.log(error.response);
          this.loading.update = false;
          $("#modal-edit-category").modal("hide");
        });
    },
    destroy(id) {
      axios
        .delete(`/admin/category/${id}`)
        .then((response) => {
          const index = this.categories.findIndex((cat) => cat.id === id);
          this.categories.splice(index, 1);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
  computed: {
    dateFormat() {
      return (date) => moment(date).format("DD-MM-YYYY HH:mm");
    },
  },
};
</script>

<style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
:root {
  --animate-duration: 300ms;
  --animate-delay: 0.9s;
}
</style>