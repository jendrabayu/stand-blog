<template>
  <div class="row mt-4">
    <div class="col-12">
      <div v-if="errors.length > 0" class="alert alert-danger">
        <div class="alert-body">
          <button class="close" @click="errors = []">
            <span>&times;</span>
          </button>
          <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
          <br />
          <ul>
            <li v-for="(error, index) in errors" :key="index">
              {{ error }}
            </li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h4>All Tags</h4>
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
                <tr v-for="(tag, index) in tags" :key="tag.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ tag.title }}</td>
                  <td>{{ tag.posts_count }}</td>
                  <td>{{ dateFormat(tag.created_at) }}</td>
                  <td>{{ dateFormat(tag.updated_at) }}</td>
                  <td>
                    <button @click="edit(tag)" class="btn btn-icon btn-warning">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                      @click="destroy(tag.id)"
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
      id="modal-create-tag"
      data-backdrop="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new tag</h5>
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
      id="modal-edit-tag"
      data-backdrop="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit tag</h5>
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
      tags: [],
      errors: [],
      success: "",
      createForm: {
        title: "",
      },
      editForm: {
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
    this.gettags();
  },
  methods: {
    gettags() {
      axios
        .get("/admin/tags")
        .then((response) => {
          this.tags = response.data;
        })
        .catch((error) => {
          this.showError(error);
        });
    },
    showCreateForm() {
      this.errors = [];
      $("#modal-create-tag").modal("show");
    },
    edit(category) {
      this.errors = [];
      $("#modal-edit-tag").modal("show");
      this.editForm.id = category.id;
      this.editForm.title = category.title;
    },
    async store() {
      this.loading.store = true;
      await axios
        .post("/admin/tag", { title: this.createForm.title })
        .then((response) => {
          this.tags.unshift(response.data);
        })
        .catch((error) => {
          this.showError(error);
        });
      this.createForm.title = "";
      this.loading.store = false;
      $("#modal-create-tag").modal("hide");
    },
    async update() {
      this.loading.update = true;
      await axios
        .put(`/admin/tag/${this.editForm.id}`, {
          title: this.editForm.title,
        })
        .then((response) => {
          const data = response.data;
          const index = this.tags.findIndex((tag) => tag.id === data.id);
          this.tags.splice(index, 1, data);
        })
        .catch((error) => {
          this.showError(error);
        });
      this.loading.update = false;
      $("#modal-edit-tag").modal("hide");
    },
    destroy(id) {
      this.errors = [];
      Swal.fire({
        title: "Are you sure?",
        text: "You will also delete all posts related to this tag",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`/admin/tag/${id}`)
            .then((response) => {
              const index = this.tags.findIndex((tag) => tag.id === id);
              this.tags.splice(index, 1);
              Swal.fire(
                "Deleted!",
                "Your category has been deleted.",
                "success"
              );
            })
            .catch((error) => {
              this.showError(error);
            });
        }
      });
    },
    showError(error) {
      if (typeof error.response.data === "object") {
        this.errors = _.flatten(_.toArray(error.response.data.errors));
      } else {
        this.errors = ["Something went wrong. Please try again."];
      }
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