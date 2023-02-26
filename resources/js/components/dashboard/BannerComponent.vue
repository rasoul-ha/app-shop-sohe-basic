<template>
  <div class="row">
    <div class="mb-3 col-sm-6 col-md-6">
      <label for="status-select" class="form-label"> Category *</label>

      <select
        class="form-select"
        id="status-select"
        name="category_id"
        @change="selectCategory()"
        v-model="category_id"
      >
        <option
          v-for="category in categories"
          :key="category.id"
          :value="category.id"
        >
          {{ category.title }}
        </option>
      </select>
    </div>
    <div class="mb-3 col-sm-6 col-md-6">
      <label for="status-select" class="form-label"> Product *</label>

      <select
        placeholder="sad"
        :disabled="!isLoadedProducts"
        class="form-select"
        id="status-select"
        name="product_id"
        v-model="product_id"
      >
        <option
          v-for="product in products"
          :key="product.id"
          :value="product.id"
        >
          <img :src="product.entity?.image?.path" />
          {{ product.title }}
        </option>
      </select>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: ["categories", "edit", "product", "category"],
  data: function () {
    return {
      category_id: "",
      product_id: "",
      products: [],
      isLoadedProducts: false,
    };
  },
  methods: {
    async selectCategory() {
      let response = await axios.get(
        `/api/banners/products/${this.category_id}`
      );
      this.products = response.data.products;
      this.isLoadedProducts = true;
    },
    async fetchProducts() {
      let response = await axios.get(
        `/api/banners/products/${this.category_id}`
      );
      this.products = response.data.products;
      this.isLoadedProducts = true;
    },
  },
  async mounted() {
    if (this.edit) {
      this.category_id = this.category;
      this.product_id = this.product;
      await this.fetchProducts();
    }
  },
};
</script>