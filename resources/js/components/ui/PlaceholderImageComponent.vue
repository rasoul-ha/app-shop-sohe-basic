<template>
  <div
    v-if="status"
    data-bs-toggle="modal"
    data-bs-target="#scrollable-modal"
    class="
      img-fluid
      avatar-lg
      rounded
      img-thumbnail
      d-flex
      justify-content-center
      align-items-center
      mb-2
      mx-1
      
    "
    style="cursor: pointer"
  >
    <i
      class="mdi mdi-camera d-flex justify-content-center align-items-center"
      style="font-size: 3rem"
    ></i>
  </div>
</template>
<script>
export default {
  props: ["status"],
};
</script>