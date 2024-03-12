<template>
  <div
    class="min-w-[220px] w-[220px] transition-all bg-indigo-700 text-white py-4 px-2"
  >
    <router-link
      :to="{ name: 'app.dashboard' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <HomeIcon class="w-6" />
      </span>
      <span class="text-l"> Dashboard </span>
    </router-link>
    <router-link
      :to="{ name: 'app.categories' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-6" />
      </span>
      <span class="text-l"> Categories </span>
    </router-link>
    <router-link
      :to="{ name: 'app.categoriesWatch' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <TableIcon class="w-6" />
      </span>
      <span class="text-l"> Watch Categories </span>
    </router-link>
    <router-link
      :to="{ name: 'app.products' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-6" />
      </span>
      <span class="text-l"> Products </span>
    </router-link>
    <router-link
      :to="{ name: 'app.orders' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <TableIcon class="w-6" />
      </span>
      <span class="text-l"> Orders </span>
    </router-link>
    <router-link
      :to="{ name: 'app.users' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <UsersIcon class="w-6" />
      </span>
      <span class="text-l"> Users </span>
    </router-link>
    <router-link
      :to="{ name: 'app.customers' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <UserGroupIcon class="w-6" />
      </span>
      <span class="text-l"> Customers </span>
    </router-link>
    <router-link
      :to="{ name: 'reports.orders' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <ChartBarIcon class="w-6" />
      </span>
      <span class="text-l"> Reports </span>
    </router-link>
    <router-link
      :to="{ name: 'app.events' }"
      class="flex items-center p-2 rounded transition-colors hover:bg-black/30"
    >
      <span class="mr-2 text-gray-300">
        <CalendarIcon class="w-6" />
      </span>
      <span class="text-l"> Sale Events </span>
    </router-link>

    <div>
      <!-- Link to toggle the dynamic menu -->
      <div
        @click="toggleMenu"
        class="flex items-center p-2 rounded transition-colors hover:bg-black/30 cursor-pointer"
      >
        <span class="mr-2 text-gray-300">
          <CollectionIcon class="w-6" />
        </span>
        <span class="text-l"> Dynamic Page </span>
        <span v-if="showMenu" class="ml-2">
          <ChevronUpIcon class="w-6" />
        </span>
        <span v-else class="ml-2">
          <ChevronDownIcon class="w-6" />
        </span>
      </div>

      <!-- Dynamic menu -->
      <div v-show="showMenu" id="dynamic-menu" class="transition-all">
        <ul>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >Home</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >About</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'dynamicpage.watch' }"
              >Watch</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >Give</router-link
            >
          </li>
        </ul>
      </div>
    </div>
    <div>
      <!-- Link to toggle the dynamic menu -->
      <div
        @click="toggleMenuSettigs"
        class="flex items-center p-2 rounded transition-colors hover:bg-black/30 cursor-pointer"
      >
        <span class="mr-2 text-gray-300">
          <CogIcon class="w-6" />
        </span>
        <span class="text-l"> Admin Settings </span>
        <span v-if="showMenuSettings" class="ml-2">
          <ChevronUpIcon class="w-6" />
        </span>
        <span v-else class="ml-2">
          <ChevronDownIcon class="w-6" />
        </span>
      </div>

      <!-- Dynamic menu -->
      <div v-show="showMenuSettings" id="dynamic-menu" class="transition-all">
        <ul>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >Access Rights</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >Page Access</router-link
            >
          </li>
          <li>
            <router-link
              class="flex items-center p-2 rounded transition-colors hover:bg-black/30 px-10"
              :to="{ name: 'app.events' }"
              >User Access</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  HomeIcon,
  UserGroupIcon,
  UsersIcon,
  ViewListIcon,
  ChartBarIcon,
  CalendarIcon,
  ChevronDownIcon,
  ChevronUpIcon,
  CollectionIcon,
  TableIcon,
  CogIcon,
} from "@heroicons/vue/outline";

import { ref } from "vue";

const showMenu = ref(false);
const showMenuSettings = ref(false);

const toggleMenu = () => {
  showMenu.value = !showMenu.value;
};

const toggleMenuSettigs = () => {
  showMenuSettings.value = !showMenuSettings.value;
};
</script>

<style scoped>
/* Your styling for the menu can go here */
#dynamic-menu ul {
  list-style: none;
  padding: 0;
}

#dynamic-menu ul li {
  display: inline-block;
  margin-right: 20px;
}

/* Style the link */
#dynamic-link {
  cursor: pointer;
  color: blue;
  text-decoration: underline;
}
</style>
