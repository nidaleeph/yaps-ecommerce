<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Global sale events</h1>
    <button type="button"
            @click="showAddNewModal()"
            class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Add new Event
    </button>
  </div>
  <EventsTable @clickEdit="editEvent"/>
  <EventModal v-model="showEventModal" :event="eventModel" @close="onModalClose"/>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import EventModal from "./EventsModal.vue";
import EventsTable from "./EventsTable.vue";

const DEFAULT_CATEGORY = {
  id: '',
  title: '',
  description: '',
  image: '',
  price: ''
}

const categories = computed(() => store.state.categories);

const eventModel = ref({...DEFAULT_CATEGORY})
const showEventModal = ref(false);

function showAddNewModal() {
  showEventModal.value = true
}

function editEvent(u) {
    eventModel.value = u;
    showAddNewModal();
}

function onModalClose() {
  eventModel.value = {...DEFAULT_CATEGORY}
}
</script>

<style scoped>

</style>
