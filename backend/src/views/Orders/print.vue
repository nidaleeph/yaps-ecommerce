<template>
  <div>
    <iframe
      style="
        width: 100%;
        height: 1500px;
        overflow: hidden;
        zoom: 0.9 !important;
        display: none;
      "
      :src="id ? `http://localhost:8000/api/print/order/${id}` : ''"
    ></iframe>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axiosClient from "../../axios.js";

const { id } = defineProps({
  id:{
    type: Number,
    default: null
  }
});

onMounted(() => {
  axiosClient.get(`print/order/${id}`);
  setTimeout(() => {
    window.close();
    // No need to set id.value to null here.
    // Handle the close event directly in your parent component
  }, 1000);
});
</script>
