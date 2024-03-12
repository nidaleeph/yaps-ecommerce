<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="flex items-center justify-between mb-3">
    <h1 v-if="!loading" class="text-3xl font-semibold">
      {{ online_watch.id ? `Update online_watch` : "Create new Watch" }}
    </h1>
  </div>
  <div class="bg-white rounded-lg shadow animate-fade-in-down">
    <Spinner
      v-if="loading"
      class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"
    />
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-3">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <CustomInput
            class="mb-2"
            v-model="online_watch.title"
            label="Watch Title"
            :errors="errors['title']"
            required
          />
          <CustomInput
            class="mb-2"
            v-model="online_watch.subtitle"
            label="Subtitle"
            :errors="errors['subtitle']"
          />
          <CustomInput
            class="mb-2"
            v-model="online_watch.url"
            label="Video URL"
            :errors="errors['url']"
            required
          />
          <treeselect
            v-model="categoryId"
            :options="options"
            :errors="errors['categories']"
            required
            placeholder="Select categories"
          />
          <div class="error-message">
            {{ errors["categories"] ? errors["categories"][0] : "" }}
          </div>
          <CustomInput
            type="richtext"
            class="mb-2"
            v-model="online_watch.description"
            label="Description"
            :errors="errors['description']"
          />
          <CustomInput
            type="checkbox"
            class="mb-2"
            v-model="online_watch.published"
            label="Published"
            :errors="errors['published']"
          />
          <CustomInput
            class="mb-2"
            v-model="online_watch.watch_code"
            label="Watch Code"
            :errors="errors['watch_code']"
            required
            disabled
          />
        </div>
        <div class="col-span-1 px-4 pt-5 pb-4">
          <image-preview
            v-model="online_watch.images"
            :images="online_watch.images"
            v-model:deleted-images="online_watch.deleted_images"
            v-model:image-positions="online_watch.image_positions"
          />
        </div>
      </div>
      <footer
        class="bg-gray-50 rounded-b-lg px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
      >
        <button
          type="submit"
          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500"
        >
          Save
        </button>
        <button
          type="button"
          @click="onSubmit($event, true)"
          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500"
        >
          Save & Close
        </button>
        <router-link
          :to="{ name: 'dynamicpage.watch' }"
          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
          ref="cancelButtonRef"
        >
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import CustomInput from "../../../components/core/CustomInput.vue";
import store from "../../../store/index.js";
import Spinner from "../../../components/core/Spinner.vue";
import { useRoute, useRouter } from "vue-router";
import ImagePreview from "../../../components/ImagePreview.vue";
import Treeselect from "vue3-treeselect";
import "vue3-treeselect/dist/vue3-treeselect.css";
import axiosClient from "../../../axios.js";

const route = useRoute();
const router = useRouter();

const online_watch = ref({
  id: null,
  title: null,
  subtitle: "",
  url: null,
  images: [],
  deleted_images: [],
  image_positions: {},
  description: "",
  published: false,
  categories: null,
  watch_code: null,
});

const getItemCount = ref(null);
const errors = ref({});
const loading = ref(false);
const options = ref([]);
const categoryId = ref(null);
const emit = defineEmits(["update:modelValue", "close"]);

onMounted(() => {
  axiosClient.get("/categoryWatch/tree").then((result) => {
    options.value = result.data;
  });

  if (route.params.id) {
    loading.value = true;
    store.dispatch("getWatch", route.params.id).then((response) => {
      loading.value = false;
      online_watch.value = response.data;
      getItemCount.value = response.data.id - 1;
      categoryId.value = response.data.categories;
    });
  } else {
    axiosClient.get("getItemCountWatch").then((result) => {
      getItemCount.value = result.data;
    });
  }
});

function findResult() {
  for (const item of options.value) {
    if (item.id === categoryId.value) {
      return item;
    }
  }
  return null;
}

watch(categoryId, () => {
  online_watch.value.categories = categoryId;
  const matchingObject = options.value.find(
    (categories) => categories.id === categoryId.value
  );
  const formattedString =
    (matchingObject.label.split(" ").length === 1
      ? matchingObject.label.substring(0, 2)
      : matchingObject.label
          .split(" ")
          .map((word) => word[0])
          .slice(0, 2)
          .join("")
    ).toLowerCase() + `-${String(getItemCount.value + 1).padStart(4, "0")}`;
  online_watch.value.watch_code = formattedString;
});

function onSubmit($event, close = false) {
  loading.value = true;
  errors.value = {};
  if (online_watch.value.id) {
    store
      .dispatch("updateWatch", online_watch.value)
      .then((response) => {
        loading.value = false;
        if (response.status === 200) {
          online_watch.value = response.data;
          store.commit("showToast", "Watch was successfully updated");
          store.dispatch("getWatches");
          if (close) {
            router.push({ name: "dynamicpage.watch" });
          }
        }
      })
      .catch((err) => {
        loading.value = false;
        errors.value = err.response.data.errors;
      });
  } else {
    store
      .dispatch("createWatch", online_watch.value)
      .then((response) => {
        loading.value = false;
        if (response.status === 201) {
          online_watch.value = response.data;
          store.commit("showToast", "Watch was successfully created");
          store.dispatch("getWatches");
          if (close) {
            router.push({ name: "dynamicpage.watch" });
          } else {
            online_watch.value = response.data;
            router.push({
              name: "dynamicpage.watch.edit",
              params: { id: response.data.id },
            });
          }
        }
      })
      .catch((err) => {
        loading.value = false;
        errors.value = err.response.data.errors;
      });
  }
}
</script>

<style scoped>
.error-message {
  color: #dc3545; /* Red color */
  font-size: 14px;
  /* Add any other styles you want for error messages */
}
</style>
