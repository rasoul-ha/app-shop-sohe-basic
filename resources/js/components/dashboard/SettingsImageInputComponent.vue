<template>
  <div class="row">
    <!-- 1 -->
    <div class="mb-3 col-6 col-md-3">
      <label class="col-form-label">Admin dashboard</label>
      <div class="d-flex flex-column">
        <img
          v-if="bg_auth === 'default' || bg_auth === null || bg_auth === ''"
          src="/assets/bg_authentication.jpg"
          alt="image"
          class="img-fluid avatar-lg rounded img-thumbnail mb-1"
          data-bs-toggle="modal"
          data-bs-target="#scrollable-modal"
          @click.prevent="imageType('bg_authentication')"
        />

        <img
          v-else
          :src="bg_auth"
          alt="image"
          style="position: relative"
          class="img-fluid avatar-lg rounded img-thumbnail mb-1"
        />
        <button
          type="button"
          class="btn-close"
          :class="{ 'd-none': bg_auth === 'default' || bg_auth === null }"
          style="position: absolute; margin: 1%"
          aria-label="Close"
          @click.prevent="removeImage('icon')"
        ></button>
      </div>
      <input type="hidden" name="bg_auth" :value="bg_auth" />
    </div>

    <!-- 2 -->
    <div class="mb-3 col-6 col-md-3">
      <label class="col-form-label">Logo</label>
      <div class="d-flex flex-column">
        <img
          v-if="app_logo === 'default' || app_logo === null || app_logo === ''"
          src="/assets/logo.png"
          alt="image"
          class="img-fluid avatar-lg rounded img-thumbnail mb-1"
          data-bs-toggle="modal"
          data-bs-target="#scrollable-modal"
          @click.prevent="imageType('logo')"
        />

        <img
          v-else
          :src="app_logo"
          alt="image"
          style="position: relative"
          class="img-fluid avatar-lg rounded img-thumbnail mb-1"
        />
        <button
          type="button"
          class="btn-close"
          :class="{ 'd-none': app_logo === 'default' || app_logo === null }"
          style="position: absolute; margin: 1%"
          aria-label="Close"
          @click.prevent="removeImage('logo')"
        ></button>
      </div>
      <input type="hidden" name="app_logo" :value="app_logo" />
    </div>
  
    <div
      class="modal fade"
      id="scrollable-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="scrollableModalTitle"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-full-width modal-dialog-scrollable"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="scrollableModalTitle">
              List of images
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-hidden="true"
            ></button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <dropzone-component></dropzone-component>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <media-list-component
                  :ability_to_select="true"
                  @select="selectImage"
                ></media-list-component>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>
<script>
import PlaceholderImageComponent from "../ui/PlaceholderImageComponent.vue";
export default {
  props: ["bg_authentication", "logo"],
  data() {
    return {
      bg_auth: this.bg_authentication,
      app_logo: this.logo,
    };
  },
  components: { PlaceholderImageComponent },
  methods: {
    imageType(type) {
      this.type = type;
    },
    selectImage(image) {
      if (this.type === "bg_authentication") {
        this.bg_auth = image.path;
      } else if (this.type === "logo") {
        this.app_logo = image.path;
      } 
    },
    removeImage(type) {
      if (type === "bg_authentication") {
        this.bg_auth = null;
      } else if (type === "logo") {
        this.app_logo = null;
      }

    },
  },
};
</script>