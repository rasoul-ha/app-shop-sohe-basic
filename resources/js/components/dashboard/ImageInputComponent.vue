<template>
  <div class="col-6 col-sm-6 col-md-6">
    <div>

      <label class="col-form-label" 
        >{{title}} <span v-if="required">*</span></label
      >
      <placholder-image-component :status="!image" />
      <div class="d-flex flex-column" v-if="image">
        <img
          :src="image.path"
          alt="image"
          style="position: relative; object-fit: cover"
          class="img-fluid avatar-lg rounded img-thumbnail mb-1"
        />
        <button
          type="button"
          class="btn-close"
          style="position: absolute; margin: 1%"
          aria-label="Close"
          @click.prevent="removeImage"
        ></button>
      </div>
      <input type="hidden" name="image" :value="image.id" />
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
            <h5 class="modal-title" id="scrollableModalTitle">List of images</h5>
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
              <media-list-component
                :ability_to_select="true"
                @select="selectImage"
              ></media-list-component>

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
import PlacholderImageComponent from "../ui/PlaceholderImageComponent";
export default {
  props: ["images", "type", "single-image", "is-required","title"],
  data() {
    return {
      image: "",
      required: this.isRequired,
    };
  },
  components: { PlacholderImageComponent },
  methods: {
    selectImage(image) {
      this.image = image;
    },
    removeImage() {
      this.image = "";
    },
  },
  created() {
    if (this.images && this.images.length) {
      this.images.forEach((image) => {
        this.image = image;
      });
    }
    if (this.singleImage !== undefined) {
      this.image = this.singleImage;
    }
  },
};
</script>