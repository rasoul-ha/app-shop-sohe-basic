
<template>
  <vue-dropzone
    ref="myVueDropzone"
    id="dropzone"
    :options="dropzoneOptions"
  ></vue-dropzone>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  name: "dropzone-component",
  components: {
    vueDropzone: vue2Dropzone,
  },
  data: function () {
    return {
      dropzoneOptions: {
        url: `/api/images/upload`,
        timeout: 100000,
        thumbnailWidth: 150,
        maxFilesize: 2,
        dictDefaultMessage:
          "<span><i class='mdi mdi-cloud-upload mdi-24px mx-1'></i> Select or drag your images</span>",
        headers: {
          "X-CSRF-TOKEN":
            document.head.querySelector("[name=csrf-token]").content,
        },
      },
    };
  },
};
</script>
<style scoped>
.vue-dropzone {
  border:unset !important;
  background-color: #f1f3fa !important;
  color:#313a46 !important
}
</style>