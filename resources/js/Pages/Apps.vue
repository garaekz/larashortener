<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import CreateApp from '@/Components/Apps/CreateApp.vue';

defineProps({
  apps: Array,
});

</script>
<template>
  <MainLayout title="Dashboard">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Apps
        </h2>
    </template>
    <div class="hidden space-y-6 p-10 pb-16 md:block">
      <div class="space-y-0.5">
        <h2 class="text-2xl font-bold tracking-tight">
          API Keys
        </h2>
        <p class="text-muted-foreground">
          Manage the API keys for your apps.
        </p>
      </div>
      <div>
        <CreateApp />
      </div>
      <div>
        <ul>
          <li v-for="app in apps" :key="app.id">
            {{ app.name }}
          </li>
        </ul>
      </div>
    </div>
  </MainLayout>
</template>
