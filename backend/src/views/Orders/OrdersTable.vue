<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select @change="getOrders(null)" v-model="perPage"
                class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3">Found {{ orders.total }} orders</span>
      </div>
      <div>
        <input v-model="search" @change="getOrders(null)"
               class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
               placeholder="Type to Search orders">
      </div>
    </div>

    <table class="table-auto w-full">
      <thead>
      <tr>
        <TableHeaderCell field="id" :sort-field="sortField" :sort-direction="sortDirection" @click="sortOrders('id')">
          ID
        </TableHeaderCell>
        <TableHeaderCell :sort-field="sortField" :sort-direction="sortDirection">
          Customer
        </TableHeaderCell>
        <TableHeaderCell field="status" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('status')">
          Status
        </TableHeaderCell>
        <TableHeaderCell field="total_price" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('total_price')">
          Price
        </TableHeaderCell>
        <TableHeaderCell field="created_at" :sort-field="sortField" :sort-direction="sortDirection"
                         @click="sortOrders('created_at')">
          Date
        </TableHeaderCell>
        <TableHeaderCell field="actions">
          Actions
        </TableHeaderCell>
      </tr>
      </thead>
      <tbody v-if="orders.loading || !orders.data.length">
      <tr>
        <td colspan="6">
          <Spinner v-if="orders.loading"/>
          <p v-else class="text-center py-8 text-gray-700">
            There are no orders
          </p>
        </td>
      </tr>
      </tbody>
      <tbody v-else>
      <tr v-for="(order, index) of orders.data">
        <td class="border-b p-2 ">{{ order.id }}</td>
        <td class="border-b p-2 ">
          {{ order.customer.first_name }} {{ order.customer.last_name }}
        </td>
        <td class="border-b p-2 ">
          <OrderStatus :order="order" />
        </td>
        <td class="border-b p-2">
          {{ $filters.currencyPHP(order.total_price) }}
        </td>
        <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
          {{ moment(order.created_at).format('MMMM D, YYYY h:mm:ss a')}}
        </td>
        <td class="border-b p-2">
  <div class="flex items-center">
    <!-- View action with eye icon -->
    <router-link :to="{ name: 'app.orders.view', params: { id: order.id }}" title="View" class="w-8 h-8 rounded-full text-indigo-700 border border-indigo-700 flex justify-center items-center hover:text-white hover:bg-indigo-700 mr-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
    </router-link>

    <!-- Print action with print icon and tooltip -->
    <a href="#" class="w-8 h-8 rounded-full text-indigo-700 border border-indigo-700 flex justify-center items-center hover:text-white hover:bg-indigo-700 mr-2" @click="printOrder(order.id)" title="Print">
      <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
        viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
      <g id="Printer">
        <path d="M57.7881012,14.03125H52.5v-8.0625c0-2.2091999-1.7909012-4-4-4h-33c-2.2091999,0-4,1.7908001-4,4v8.0625H6.2119002
          C2.7871001,14.03125,0,16.8183498,0,20.2431507V46.513649c0,3.4248009,2.7871001,6.2119026,6.2119002,6.2119026h2.3798995
          c0.5527,0,1-0.4472008,1-1c0-0.5527-0.4473-1-1-1H6.2119002C3.8896,50.7255516,2,48.8359489,2,46.513649V20.2431507
          c0-2.3223,1.8896-4.2119007,4.2119002-4.2119007h51.5762024C60.1102982,16.03125,62,17.9208508,62,20.2431507V46.513649
          c0,2.3223-1.8897018,4.2119026-4.2118988,4.2119026H56c-0.5527992,0-1,0.4473-1,1c0,0.5527992,0.4472008,1,1,1h1.7881012
          C61.2128983,52.7255516,64,49.9384499,64,46.513649V20.2431507C64,16.8183498,61.2128983,14.03125,57.7881012,14.03125z
          M13.5,5.96875c0-1.1027999,0.8971996-2,2-2h33c1.1027985,0,2,0.8972001,2,2v8h-37V5.96875z"/>
        <path d="M44,45.0322495H20c-0.5517998,0-0.9990005,0.4472008-0.9990005,0.9990005S19.4482002,47.0302505,20,47.0302505h24
          c0.5517006,0,0.9990005-0.4472008,0.9990005-0.9990005S44.5517006,45.0322495,44,45.0322495z"/>
        <path d="M44,52.0322495H20c-0.5517998,0-0.9990005,0.4472008-0.9990005,0.9990005S19.4482002,54.0302505,20,54.0302505h24
          c0.5517006,0,0.9990005-0.4472008,0.9990005-0.9990005S44.5517006,52.0322495,44,52.0322495z"/>
        <circle cx="7.9590998" cy="21.8405495" r="2"/>
        <circle cx="14.2856998" cy="21.8405495" r="2"/>
        <circle cx="20.6121998" cy="21.8405495" r="2"/>
        <path d="M11,62.03125h42v-26H11V62.03125z M13.4036999,38.4349518h37.1925964v21.1925964H13.4036999V38.4349518z"/>
      </g>
      </svg>
    </a>
  </div>
</td>


      </tr>
      </tbody>
    </table>

    <div v-if="!orders.loading" class="flex justify-between items-center mt-5">
      <div v-if="orders.data.length">
        Showing from {{ orders.from }} to {{ orders.to }}
      </div>
      <nav
        v-if="orders.total > orders.limit"
        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
        aria-label="Pagination"
      >
        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
        <a
          v-for="(link, i) of orders.links"
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
              i === orders.links.length - 1 ? 'rounded-r-md' : '',
              !link.url ? ' bg-gray-100 text-gray-700': ''
            ]"
          v-html="link.label"
        >
        </a>
      </nav>
    </div>
  </div>
    <print
      v-if="printNow"
      :id="orderId"
    />
</template>

<script setup>
import moment from 'moment';
import {computed, onMounted, ref, watch} from "vue";
import store from "../../store";
import Spinner from "../../components/core/Spinner.vue";
import {PRODUCTS_PER_PAGE} from "../../constants";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {DotsVerticalIcon, PencilIcon, TrashIcon} from '@heroicons/vue/outline'
import OrderStatus from "./OrderStatus.vue";
import print from './print.vue';

const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref('');
const printNow = ref(false);
const orders = computed(() => store.state.orders);
const sortField = ref('updated_at');
const sortDirection = ref('desc')

const orderId = ref(null)
const showOrderModal = ref(false);

const emit = defineEmits(['clickEdit'])

onMounted(() => {
  getOrders();
})

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getOrders(link.url)
}

async function printOrder(id) {
  orderId.value = id
  printNow.value = true;

  setTimeout(() => {
    printNow.value = false;
    // Handle the close event directly in your parent component
  }, 1000);
  
}

function getOrders(url = null) {
  // console.log(search)
  store.dispatch("getOrders", {
    url,
    search: search.value,
    per_page: perPage.value,
    sort_field: sortField.value,
    sort_direction: sortDirection.value
  });
}

function sortOrders(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field;
    sortDirection.value = 'asc'
  }

  getOrders()
}

function showAddNewModal() {
  showOrderModal.value = true
}

function deleteOrder(order) {
  if (!confirm(`Are you sure you want to delete the order?`)) {
    return
  }
  store.dispatch('deleteOrder', order.id)
    .then(res => {
      // TODO Show notification
      store.dispatch('getOrders')
    })
}

function showOrder(p) {
  emit('clickShow', p)
}
</script>

<style scoped>

</style>
