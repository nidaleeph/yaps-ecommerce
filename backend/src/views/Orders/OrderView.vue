<template>
  <div v-if="order">

    <!--  Order Details-->
    <div>
      <h2 class="flex justify-between items-center text-xl font-semibold pb-2 border-b border-gray-300">
        Order Details
        <OrderStatus :order="order" />
      </h2>
      <table>
        <tbody>
        <tr>
          <td class="font-bold py-1 px-2">Order #</td>
          <td>{{ order.id }}</td>
        </tr>
        <tr>
          <td class="font-bold py-1 px-2">Order Date</td>
          <td>{{  moment(order.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
        </tr>
        <tr>
          <td class="font-bold py-1 px-2">Order Status</td>
          <td>
            <select v-model="order.status" @change="onStatusChange">
              <option v-for="status of orderStatuses" :value="status">{{status}}</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="font-bold py-1 px-2">SubTotal</td>
          <td>{{ $filters.currencyPHP(order.total_price) }}</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!--/  Order Details-->

    <!--  Customer Details-->
    <div>
      <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Customer Details</h2>
      <table>
        <tbody>
        <tr>
          <td class="font-bold py-1 px-2">Full Name</td>
          <td>{{ order.customer.first_name }} {{ order.customer.last_name }}</td>
        </tr>
        <tr>
          <td class="font-bold py-1 px-2">Email</td>
          <td>{{ order.customer.email }}</td>
        </tr>
        <tr>
          <td class="font-bold py-1 px-2">Phone</td>
          <td>{{ order.customer.phone }}</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!--/  Customer Details-->

    <!--  Addresses Details-->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Billing Address</h2>
        <!--  Billing Address Details-->
        <div>
          {{ order.customer.billingAddress.address1 }}, {{ order.customer.billingAddress.address2 }} <br>
          {{ order.customer.billingAddress.city }}, {{ order.customer.billingAddress.zipcode }} <br>
          {{ order.customer.billingAddress.state }}, {{ order.customer.billingAddress.country }} <br>
        </div>
        <!--/  Billing Address Details-->
      </div>
      <div>
        <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Shipping Address</h2>
        <!--  Shipping Address Details-->
        <div>
          {{ order.customer.shippingAddress.address1 }}, {{ order.customer.shippingAddress.address2 }} <br>
          {{ order.customer.shippingAddress.city }}, {{ order.customer.shippingAddress.zipcode }} <br>
          {{ order.customer.shippingAddress.state }}, {{ order.customer.shippingAddress.country }} <br>
        </div>
        <!--/  Shipping Address Details-->
      </div>
    </div>
    <!--/  Customer Details-->

    <!--    Order Items-->
    <div>
      <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Order Items</h2>
      <div v-for="item of order.items">
        <!-- Order Item -->
        <div class="flex flex-col sm:flex-row items-center  gap-4">
          <a href="#"
             class="w-36 h-32 flex items-center justify-center overflow-hidden">
            <img :src="item.product.image" class="object-cover" alt=""/>
          </a>
          <div class="flex flex-col justify-between flex-1">
            <div class="flex justify-between mb-3">
              <h3>
                {{ item.product.title }}
              </h3>
            </div>
            <div class="flex justify-between items-center">
              <div class="flex items-center">Qty: {{ item.quantity }}</div>
              <span class="text-lg font-semibold"> {{ $filters.currencyPHP(item.unit_price) }} </span>
            </div>
          </div>
        </div>
        <!--/ Order Item -->
        <hr class="my-3"/>
      </div>
    </div>
    <!--/    Order Items-->

  </div>
  <div id="confirmation-modal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to change the order status to "<span id="status-name"></span>"?</p>
    <button id="confirm-yes">Yes</button>
    <button id="confirm-no">No</button>
  </div>
</div>

</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import {useRoute} from "vue-router";
import axiosClient from "../../axios.js";
import OrderStatus from "./OrderStatus.vue";
import moment from 'moment';

const route = useRoute()

const order = ref(null);
const this_order = ref(null);
const orderStatuses = ref([]);

onMounted(() => {
  store.dispatch('getOrder', route.params.id)
    .then(({data}) => {
      order.value = data
      this_order.value = data.status
    })

  axiosClient.get(`/orders/statuses`)
    .then(({data}) => orderStatuses.value = data)
})

function onStatusChange() {
  const statusName = order.value.status;
  const modal = document.getElementById('confirmation-modal');
  const statusNameElement = document.getElementById('status-name');
  statusNameElement.textContent = statusName;

  modal.style.display = 'block';

  const confirmYesButton = document.getElementById('confirm-yes');
  const confirmNoButton = document.getElementById('confirm-no');
  console.log(this_order.value,'test')
  console.log(order.value,'test2')
  confirmYesButton.onclick = function () {
    modal.style.display = 'none';
    axiosClient.post(`/orders/change-status/${order.value.id}/${order.value.status}`)
      .then(({ data }) => {
        if(data){
          if(data.failed){
            store.commit('showToast', {message: data.message, color: 'bg-red-500'});
            order.value.status = this_order.value
          }
        }else{
          store.commit('showToast', `Order status was successfully changed into "${order.value.status}"`);
          store.dispatch('getOrder', route.params.id)
          .then(({data}) => {
            order.value = data
            this_order.value = data.status
          })
          // order.value.status = this_order.value
        }
      })
  };

  confirmNoButton.onclick = function () {
    modal.style.display = 'none';
    order.value.status = this_order.value
  };
}


</script>

<style scoped>
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: white;
  width: 300px;
  margin: 100px auto;
  padding: 20px;
  text-align: center;
}

button {
  padding: 10px 20px;
  margin: 10px;
}

button#confirm-yes {
  background-color: #4CAF50;
  color: white;
}

button#confirm-no {
  background-color: #f44336;
  color: white;
}

</style>
