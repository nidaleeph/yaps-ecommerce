<template>
  <div class="mb-2 flex items-center justify-between">
    <h1 class="text-3xl font-semibold">Dashboard</h1>
    <div class="flex items-center">
      <label class="mr-2">Change Date Period</label>
      <!-- <CustomInput type="select" v-model="chosenDate" @change="onDatePickerChange" :select-options="dateOptions"/> -->
      <CustomInput type="date-range" v-model="chosenDate2" @change="onDatePickerChange"/>
      <div>
        <!-- <VueDatePicker v-model="date"></VueDatePicker> -->
      </div>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" @click="downloadCsv">Download</button>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-6 gap-3 mb-4">
    <!--    Active Customers-->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
      <label class="text-lg font-semibold block mb-2">Active Customers</label>
      <template v-if="!loading.customersCount">
        <span class="text-3xl font-semibold">{{ customersCount }}</span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <!--/    Active Customers-->
    <!--    Active Products -->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
         style="animation-delay: 0.1s">
      <label class="text-lg font-semibold block mb-2">Active Products</label>
      <template v-if="!loading.productsCount">
        <span class="text-3xl font-semibold">{{ productsCount }}</span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <!--/    Active Products -->
    <!--    Paid Orders -->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
         style="animation-delay: 0.2s">
      <label class="text-lg font-semibold block mb-2">Paid Orders</label>
      <template v-if="!loading.paidOrders">
        <span class="text-3xl font-semibold">{{ paidOrders }}</span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <!--/    Paid Orders -->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
      <label class="text-lg font-semibold block mb-2">Active Event</label>
      <template v-if="!loading.customersCount">
        <span class="text-3xl font-semibold text-center">{{ activeEvent.name }}<br><span style="color: red;">{{ activeEvent.percentage }}% OFF</span></span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <!--    Total Income -->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center"
         style="animation-delay: 0.3s">
      <label class="text-lg font-semibold block mb-2">Date Income</label>
      <template v-if="!loading.totalIncome">
        <span class="text-3xl font-semibold">{{ totalIncome }}</span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center"
         style="animation-delay: 0.3s">
      <label class="text-lg font-semibold block mb-2">Projected Income</label>
      <template v-if="!loading.allPrice">
        <span class="text-3xl font-semibold">{{ allTimeTotalIncome }}</span>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <!--/    Total Income -->
  </div>

  <div class="grid grid-rows-1 md:grid-rows-2 md:grid-flow-col grid-cols-1 md:grid-cols-3 gap-3">
    <div class="col-span-1 md:col-span-2 row-span-1 md:row-span-2 bg-white py-6 px-5 rounded-lg shadow">
      <label class="text-lg font-semibold block mb-2">Latest Orders</label>
      <template v-if="!loading.latestOrders">
        <div v-for="o of latestOrders" :key="o.id" class="py-2 px-3 hover:bg-gray-50">
          <p>
            <router-link :to="{name: 'app.orders.view', params: {id: o.id}}" class="text-indigo-700 font-semibold">
              Order #{{ o.id }}
            </router-link>
            created {{ o.created_at }}. {{ o.items }} items
          </p>
          <p class="flex justify-between">
            <span>{{ o.first_name }} {{ o.last_name }}</span>
            <span>{{ $filters.currencyPHP(o.total_price) }}</span>
          </p>
        </div>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <div class="bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
      <label class="text-lg font-semibold block mb-2">Orders by Category</label>
      <template v-if="!loading.ordersByCategory">
        <DoughnutChart :width="400" :height="400" :data="ordersByCategory"/>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
    <div class="bg-white py-6 px-5 rounded-lg shadow">
      <label class="text-lg font-semibold block mb-2">Latest Customers</label>
      <template v-if="!loading.latestCustomers">
        <router-link :to="{name: 'app.customers.view', params: {id: c.id}}" v-for="c of latestCustomers" :key="c.id"
                     class="mb-3 flex">
          <div class="w-12 h-12 bg-gray-200 flex items-center justify-center rounded-full mr-2">
            <UserIcon class="w-5"/>
          </div>
          <div>
            <h3>{{ c.first_name }} {{ c.last_name }}</h3>
            <p>{{ c.email }}</p>
          </div>
        </router-link>
      </template>
      <Spinner v-else text="" class=""/>
    </div>
  </div>

</template>

<script setup>
import {UserIcon} from '@heroicons/vue/outline'
import DoughnutChart from '../components/core/Charts/Doughnut.vue'
import axiosClient from "../axios.js";
import {computed, onMounted, ref} from "vue";
import Spinner from "../components/core/Spinner.vue";
import CustomInput from "../components/core/CustomInput.vue";
import {useStore} from "vuex";
import moment from 'moment';


const store = useStore();
const dateOptions = computed(() => store.state.dateOptions);
const chosenDate = ref('all')
const philippinesTimeZone = 'Asia/Manila';
const startDate = moment(new Date().toLocaleString('en-US', { timeZone: philippinesTimeZone })).format('YYYY-MM-01');
const chosenDate2 = ref({ startDate: startDate, endDate: moment(new Date().toLocaleString('en-US', { timeZone: philippinesTimeZone })).format('YYYY-MM-DD') });

const loading = ref({
  customersCount: true,
  productsCount: true,
  paidOrders: true,
  totalIncome: true,
  allTimeTotalIncome: false,
  ordersByCategory: true,
  latestCustomers: true,
  latestOrders: true,
  activeEvent: true
})
const customersCount = ref(0);
const activeEvent = ref({});
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);
const allTimeTotalIncome = ref(0);
const ordersByCategory = ref([]);
const latestCustomers = ref([]);
const latestOrders = ref([]);
const allPrice = ref(0);

function updateDashboard() {
  
  const d = chosenDate.value
  const date = chosenDate2.value
  loading.value = {
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
    ordersByCategory: true,
    latestCustomers: true,
    latestOrders: true,
    allPrice: true,
    activeEvent: true
  }
  axiosClient.get(`/dashboard/customers-count`, {params: {d,date}}).then(({data}) => {
    customersCount.value = data
    loading.value.customersCount = false;
  })

  axiosClient.get(`/dashboard/get-activeEvent`, {params: {d,date}}).then(({data}) => {
    activeEvent.value = data
    loading.value.activeEvent = false;
  })

  axiosClient.post(`/dashboard/all-items-price`).then(({data}) => {
    allPrice.value = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    })
      .format(data);
    loading.value.allPrice = false;
  })
  axiosClient.get(`/dashboard/products-count`, {params: {d,date}}).then(({data}) => {
    productsCount.value = data;
    loading.value.productsCount = false;
  })
  axiosClient.get(`/dashboard/orders-count`, {params: {d,date}}).then(({data}) => {
    paidOrders.value = data;
    loading.value.paidOrders = false;
  })
  axiosClient.get(`/dashboard/income-amount`, {params: {d,date}}).then(({data}) => {
    totalIncome.value = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    })
      .format(data);
    loading.value.totalIncome = false;
  })
  axiosClient.get(`/dashboard/alltime-income-amount`, {params: {d}}).then(({data}) => {
    allTimeTotalIncome.value = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
      minimumFractionDigits: 2
    })
      .format(data);
    loading.value.allTimeTotalIncome = false;
  })
  axiosClient.get(`/dashboard/orders-by-category`, {params: {d,date}}).then(({data: type}) => {
    loading.value.ordersByCategory = false;
    const chartData = {
      labels: [],
      datasets: [{
        backgroundColor: [
            '#41B883', '#E46651', '#00D8FF', '#DD1B16',
            '#7B68EE', '#F08080', '#6A5ACD', '#32CD32',
            '#B0E0E6', '#87CEEB', '#FFD700', '#DC143C',
            '#8A2BE2', '#FFA500', '#228B22', '#8B4513',
            '#2E8B57', '#9400D3', '#FF1493', '#00CED1',
        ],
        data: [],
        price: [], // Store prices
      }]
    }
    // Create an array to store the price information
      const prices = [];

    type.forEach(c => {
      chartData.labels.push(c.name);
      chartData.datasets[0].data.push(c.count);
      chartData.datasets[0].price.push(c.price_per_category); // Store prices

      // Add tooltips with price information
    });
    ordersByCategory.value = chartData
  })

  axiosClient.get(`/dashboard/latest-customers`, {params: {d,date}}).then(({data: customers}) => {
    latestCustomers.value = customers;
    loading.value.latestCustomers = false;
  })
  axiosClient.get(`/dashboard/latest-orders`, {params: {d,date}}).then(({data: orders}) => {
    latestOrders.value = orders.data;
    loading.value.latestOrders = false;
  })
}

function onDatePickerChange(dateRange) {
  chosenDate2.value = dateRange
  updateDashboard()
}

function downloadFile(details) {
  if (details) {
    if (typeof details == 'object') {
      window.location =
        '/web/download?path=' +
        details[0] +
        '&file=' +
        details[1] +
        '&header=' +
        details[2];
    } else {
      window.location = '/web/download?path=' + details;
    }
    // console.log(typeof details);
  }
}

async function downloadCsv() {
  const date = chosenDate2.value; // Replace with your date retrieval logic
  console.log(date)
  try {
    // Make an HTTP request to get the download URL from Laravel
    const response = await axiosClient.post('/dashboard/csv', date, { responseType: 'blob' });
    
    // Check if the request was successful
    if (response.status === 200) {
      // Create a Blob from the response data
      const blob = new Blob([response.data], { type: 'application/csv' });

      // Create a URL for the Blob
      const url = window.URL.createObjectURL(blob);

      // Create an anchor element for downloading
      const a = document.createElement('a');
      a.href = url;
      a.download = `Reports-from-${date.startDate}-to-${date.endDate}.csv`; // Set the desired file name

      // Trigger a click event on the anchor element to start the download
      a.click();

      // Clean up by revoking the Object URL to release resources
      window.URL.revokeObjectURL(url);
    } else {
      console.error('Error downloading the CSV file:', response);
    }
  } catch (error) {
    console.error('Error downloading the CSV file:', error);
  }
}



onMounted(() => updateDashboard())
</script>

<style scoped>

</style>
