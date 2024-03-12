<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Watch Categories</h1>
    <button
      type="button"
      @click="showAddNewModal()"
      class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Add new Category
    </button>
  </div>
  <CategoriesWatchTable @clickEdit="editCategory" />
  <CategoryWatchModal
    v-model="showCategoryWatchModal"
    :category="categoryModel"
    @close="onModalClose"
  />
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import store from "../../store";
import CategoryWatchModal from "./CategoryWatchModal.vue";
import CategoriesWatchTable from "./CategoriesWatchTable.vue";

const DEFAULT_CATEGORY = {
  id: "",
  title: "",
  description: "",
  image: "",
  price: "",
};

const categoriesWatch = computed(() => store.state.categoriesWatch);

const categoryModel = ref({ ...DEFAULT_CATEGORY });
const showCategoryWatchModal = ref(false);

function showAddNewModal() {
  showCategoryWatchModal.value = true;
}

function editCategory(u) {
  categoryModel.value = u;
  showAddNewModal();
}

function onModalClose() {
  categoryModel.value = { ...DEFAULT_CATEGORY };
}
</script>

<style scoped></style>
