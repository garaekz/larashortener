<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import CreateApp from '@/Components/Apps/CreateApp.vue';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Button } from '@/Components/ui/button';
import { ClipboardDocumentIcon as CopyIcon } from '@heroicons/vue/24/outline';
import { useClipboard } from '@vueuse/core';
import ConfirmationModal from '@/Components/Shared/ConfirmationModal.vue';

defineProps({
  apps: Array,
});

const confirmRefreshRef = ref(null);
const { copy } = useClipboard()

const resetApiKey = async (app) => {
  if (app.apiKey) return;
  
  const ok = await confirmRefreshRef.value.show();
  if (ok) {
    const { data } = await axios.get(`/api/apps/${app.id}/token`);
    app.apiKey = data.token;
  }
};

const copyApiKey = async (app) => {
  await resetApiKey(app);
  if (app.apiKey) {
    copy(app.apiKey);
  }
};

const showApiKey = async (app) => {
  await resetApiKey(app);
  if (app.apiKey) {
    app.showApiKey = app.apiKey;
  }
};
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
      <div class="flex flex-col space-y-4 py-2">
        <div
          v-for="app in apps"
          class="space-y-2 flex flex-row items-center justify-between rounded-lg border p-4">
          <div class="space-y-0.5">
            <h4 class="font-medium text-base">
              {{ app.name }}
            </h4>
            <p class="text-sm text-muted-foreground">
              {{ app.domain }}
            </p>
          </div>
          <div class="flex items-center space-x-2 pt-4">
            <Button @click="copyApiKey(app)" size="sm" class="px-2.5">
              <span class="sr-only">Copy</span>
              <CopyIcon class="h-4 w-4" />
            </Button>
            <div class="grid flex-1 gap-2">
              <Label for="link" class="sr-only">
                Link
              </Label>
              <Input
                v-model="app.showApiKey"
                id="link"
                default-value="********************************"
                read-only
                disabled
                class="h-9 w-[420px] text-sm bg-transparent focus-visible:ring-0 focus-visible:ring-offset-transparent focus-visible:ring-offset-0 focus-visible:ring-transparent focus-visible:ring-opacity-0"
              />
            </div>
            <button @click="showApiKey(app)" class="hover:underline">
              Show
            </button>
          </div>
        </div>
      </div>
    </div>
    <ConfirmationModal ref="confirmRefreshRef" />
  </MainLayout>
</template>
