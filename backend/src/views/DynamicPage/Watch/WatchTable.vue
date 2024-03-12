<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select
          @change="getWatches(null)"
          v-model="perPage"
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Found {{ watches.total }} content</span>
      </div>
      <div class="flex items-center">
        <label class="mr-2">Choose Category</label>
        <CustomInput
          type="select-category"
          v-model="chosenCategory"
          @change="onCategoryChange"
          :select-options="categories"
        />
        <div>
          <!-- <VueDatePicker v-model="date"></VueDatePicker> -->
        </div>
      </div>
      <div>
        <input
          v-model="search"
          @change="getWatches(null)"
          class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Type to Search content"
        />
      </div>
    </div>

    <table class="table-auto w-full">
      <thead>
        <tr>
          <TableHeaderCell
            field="image"
            :sort-field="sortField"
            :sort-direction="sortDirection"
          >
            Image
          </TableHeaderCell>
          <TableHeaderCell
            field="title"
            :sort-field="sortField"
            :sort-direction="sortDirection"
            @click="sortWatches('title')"
          >
            Title
          </TableHeaderCell>
          <TableHeaderCell
            field="watch_code"
            :sort-field="sortField"
            :sort-direction="sortDirection"
            @click="sortWatches('watch_code')"
          >
            Watch Code
          </TableHeaderCell>
          <TableHeaderCell
            field="category"
            :sort-field="sortField"
            :sort-direction="sortDirection"
            @click="sortWatches('category')"
          >
            Category
          </TableHeaderCell>
          <TableHeaderCell
            field="published"
            :sort-field="sortField"
            :sort-direction="sortDirection"
            @click="sortWatches('published')"
          >
            Published
          </TableHeaderCell>
          <TableHeaderCell
            field="updated_at"
            :sort-field="sortField"
            :sort-direction="sortDirection"
            @click="sortWatches('updated_at')"
          >
            Last Updated At
          </TableHeaderCell>
          <TableHeaderCell field="actions"> Actions </TableHeaderCell>
        </tr>
      </thead>
      <tbody v-if="watches.loading || !watches.data.length">
        <tr>
          <td colspan="6">
            <Spinner v-if="watches.loading" />
            <p v-else class="text-center py-8 text-gray-700">
              There are no content
            </p>
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(online_watch, index) of watches.data">
          <td class="border-b p-2">
            <img
              v-if="online_watch.image_url"
              class="w-16 h-16 object-cover"
              :src="online_watch.image_url"
              :alt="online_watch.title"
            />
            <img
              v-else
              class="w-16 h-16 object-cover"
              src="../../../assets/noimage.png"
            />
          </td>
          <td
            class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis"
          >
            {{ online_watch.title }}
          </td>
          <td
            class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis"
          >
            {{ online_watch.watch_code }}
          </td>
          <td class="border-b p-2">
            {{ online_watch.categories }}
          </td>
          <td class="border-b p-2">
            {{ online_watch.published ? "Yes" : "No" }}
          </td>
          <td class="border-b p-2">
            {{
              moment(online_watch.updated_at).format("MMMM D, YYYY h:mm:ss a")
            }}
          </td>
          <td class="border-b p-2">
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                >
                  <DotsVerticalIcon
                    class="h-5 w-5 text-indigo-500"
                    aria-hidden="true"
                  />
                </MenuButton>
              </div>

              <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
              >
                <MenuItems
                  class="absolute z-10 right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <router-link
                        :to="{
                          name: 'dynamicpage.watch.edit',
                          params: { id: online_watch.id },
                        }"
                        :class="[
                          active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]"
                      >
                        <PencilIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-indigo-400"
                          aria-hidden="true"
                        />
                        Edit
                      </router-link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <button
                        :class="[
                          active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                          'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                        ]"
                        @click="deleteWatch(online_watch)"
                      >
                        <TrashIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-indigo-400"
                          aria-hidden="true"
                        />
                        Delete
                      </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="!watches.loading" class="flex justify-between items-center mt-5">
      <div v-if="watches.data.length">
        Showing from {{ watches.from }} to {{ watches.to }}
      </div>
      <nav
        v-if="watches.total > watches.limit"
        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
        aria-label="Pagination"
      >
        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
        <a
          v-for="(link, i) of watches.links"
          :key="i"
          :disabled="!link.url"
          href="#"
          @click="getForPage($event, link)"
          aria-current="page"
          class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
          :class="[
            link.active
              ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
              : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
            i === 0 ? 'rounded-l-md' : '',
            i === watches.links.length - 1 ? 'rounded-r-md' : '',
            !link.url ? ' bg-gray-100 text-gray-700' : '',
          ]"
          v-html="link.label"
        >
        </a>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "vue";
import store from "../../../store";
import Spinner from "../../../components/core/Spinner.vue";
import { ONLINE_WATCHES_PER_PAGE } from "../../../constants";
import TableHeaderCell from "../../../components/core/Table/TableHeaderCell.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
  DotsVerticalIcon,
  PencilIcon,
  TrashIcon,
} from "@heroicons/vue/outline";
import moment from "moment";
import CustomInput from "../../../components/core/CustomInput.vue";
import axiosClient from "../../../axios.js";

const perPage = ref(ONLINE_WATCHES_PER_PAGE);
const search = ref("");
const watches = computed(() => store.state.watches);
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const categories = ref([]);
const chosenCategory = ref(0);

const online_watch = ref({});

onMounted(() => {
  getWatches();
  axiosClient.get(`/categoryWatch/categoryWithAll`).then(({ data }) => {
    categories.value = data;
  });
});

function onCategoryChange() {
  search.value = "";
  getWatches();
}

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getWatches(link.url);
}

function getWatches(url = null) {
  store.dispatch("getWatches", {
    url,
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
    category: chosenCategory.value,
  });
}

function sortWatches(field) {
  if (field === sortField.value) {
    if (sortDirection.value === "desc") {
      sortDirection.value = "asc";
    } else {
      sortDirection.value = "desc";
    }
  } else {
    sortField.value = field;
    sortDirection.value = "asc";
  }

  getWatches();
}

function deleteWatch(online_watch) {
  if (!confirm(`Are you sure you want to delete the online_watch?`)) {
    return;
  }
  store.dispatch("deleteWatch", online_watch.id).then((res) => {
    store.commit("showToast", "Watch was successfully deleted");
    store.dispatch("getWatches");
  });
}

async function downloadCsv() {
  try {
    // Make an HTTP request to get the download URL from Laravel
    const response = await axiosClient.get(
      `/watches/category/csv/${chosenCategory.value}`,
      { responseType: "blob" }
    );

    // Check if the request was successful
    if (response.status === 200) {
      // Create a Blob from the response data
      const blob = new Blob([response.data], { type: "application/csv" });

      // Create a URL for the Blob
      const url = window.URL.createObjectURL(blob);

      // Create an anchor element for downloading
      const a = document.createElement("a");
      a.href = url;
      const filteredCategoryNames = categories.value
        .filter((category) => category.id == chosenCategory.value)
        .map((category) => category.name);
      a.download = `Watches-Category-${filteredCategoryNames[0]}.csv`; // Set the desired file name

      // Trigger a click event on the anchor element to start the download
      a.click();

      // Clean up by revoking the Object URL to release resources
      window.URL.revokeObjectURL(url);
    } else {
      console.error("Error downloading the CSV file:", response);
    }
  } catch (error) {
    console.error("Error downloading the CSV file:", error);
  }
}
</script>

<style scoped></style>
