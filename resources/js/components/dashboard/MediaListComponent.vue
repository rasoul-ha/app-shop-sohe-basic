<template>
  <div class="card-body">
    <div class="page-title-box">
      <a
        href="#"
        @click.prevent="getImages"
        class="btn btn-sm-block btn-primary mb-2"
      >
        <i class="dripicons-clockwise me-1"></i>

        Update the list      </a>

      <template v-if="loading && !isLoaded">
        <div class="alert alert-dark" role="alert">
          <i class="dripicons-information me-2"></i> Loading
        </div>
      </template>
      <template v-if="isLoaded && !images.data.length">
        <div class="alert alert-info" role="alert">
          <i class="dripicons-information me-2"></i> The list of images is empty
        </div>
      </template>

      <div class="table-responsive" v-else>
        <table
        v-if="typeof images.data === 'object'"
          class="table text-center table-centered mb-0 table-sm table-striped"
        >
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Image</th>
              <th>Uploaded time </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(image, i) in images.data" :key="image.id">
                  <td>{{ i + images.meta.from }}</td>
                  <td>
                    <img
                      :src="image.path"
                      class="rounded avatar-sm"
                      :alt="image.filename"
                      style="object-fit: cover"
                    />
                  </td>
                  <td>{{ image.created_at }}</td>
                  <td>
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Delete image"
                      @click.prevent="removeImage(image.id)"
                      style="cursor: pointer"
                      class="action-icon"
                    >
                      <i class="mdi mdi-delete"></i
                    ></a>
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Select image"
                      style="cursor: pointer"
                      v-if="ability_to_select"
                      @click.prevent="selectImage(image)"
                      class="action-icon"
                    >
                      <i class="dripicons-checkmark"></i
                    ></a>
                  </td>
                </tr>

          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center align-items-center mt-2">
        <Pagination
            :data="images"
            @pagination-change-page="getImages"
            align="center"
          >
            <template #prev-nav>
              <span> Previous</span>
            </template>
            <template #next-nav>
              <span>Next </span>
            </template>
          </Pagination>
          <notifications position="bottom right" />

      </div>


    </div>
  </div>
</template>
<script>
import LaravelVuePagination from "laravel-vue-pagination";
export default {
  name: "media-list-component",
  props: {
    ability_to_select: Boolean,
  },

  data() {
    return {
      images: {},
      loading: false,
      isLoaded: false,
      errorMessage: "",
    };
  },
  components: {
    Pagination: LaravelVuePagination,
  },
  methods: {
    removeImage(id) {
      const _this = this;
      Swal.fire({
        title: "R u sure?",
        text: `You cannot return this image!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancell",
        confirmButtonColor: "#6169d0",
        cancelButtonColor: "#d54e69",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`/api/images/remove/${id}`)
            .then(() => successMessage("Image deleted successfully"))
            .then(() => _this.getImages());
        }
      });
    },
    async getImages(page = 1) {
      this.loading = true;
      let {data} = await axios.get("/api/images?page=" + page);
      this.images = data;

      this.loading = false;
      this.isLoaded = true;
    },
    selectImage(image) {
      this.$emit("select", image);
      successMessage("Image selected successfully");
    },
  },
  async created() {
    await this.getImages();
  },
};
</script>