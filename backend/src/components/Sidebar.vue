<template>
  <div class="min-w-[160px] w-[160px]  transition-all bg-indigo-700 text-white py-4 px-2">
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <HomeIcon class="w-6"/>
      </span>
      <span class="text-l">
        Dashboard
      </span>
    </router-link>
    <router-link :to="{name: 'app.categories'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-6"/>
      </span>
      <span class="text-l">
        Categories
      </span>
    </router-link>
    <router-link :to="{name: 'app.products'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-6"/>
      </span>
      <span class="text-l">
        Products
      </span>
    </router-link>
    <router-link :to="{name: 'app.orders'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-6"/>
      </span>
      <span class="text-l">
        Orders
      </span>
    </router-link>
    <router-link :to="{name: 'app.users'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <UsersIcon class="w-6"/>
      </span>
      <span class="text-l">
        Users
      </span>
    </router-link>
    <router-link :to="{name: 'app.customers'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <UserGroupIcon class="w-6"/>
      </span>
      <span class="text-l">
        Customers
      </span>
    </router-link>
    <router-link :to="{name: 'reports.orders'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <ChartBarIcon class="w-6"/>
      </span>
      <span class="text-l">
        Reports
      </span>
    </router-link>
    <router-link :to="{name: 'app.events'}"
                 class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
      <span class="mr-2 text-gray-300">
        <CalendarIcon class="w-6"/>
      </span>
      <span class="text-l">
        Sale Events
      </span>
    </router-link>
  </div>
</template>

<script setup>
  import {HomeIcon, UserGroupIcon, UsersIcon, ViewListIcon, ChartBarIcon, CalendarIcon} from '@heroicons/vue/outline'
</script>

<style scoped>

</style>
