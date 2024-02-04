<script setup>
import { ref } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'

</script>
<template>
    <MainLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Shorts
            </h2>
        </template>

        <div class="space-y-6 py-6 md:p-10 pb-16 md:block">
            <div class="space-y-0.5">
                <h2 class="text-2xl font-bold tracking-tight">
                    Shorts
                </h2>
                <p class="text-muted-foreground">
                    Manage your shortened URLs.
                </p>
            </div>
            <div>
                <Tabs default-value="account" class="w-[400px]">
    <TabsList>
      <TabsTrigger value="account">
        Account
      </TabsTrigger>
      <TabsTrigger value="password">
        Password
      </TabsTrigger>
    </TabsList>
    <TabsContent value="account">
      Make changes to your account here.
    </TabsContent>
    <TabsContent value="password">
      Change your password here.
    </TabsContent>
  </Tabs>
            </div>
        </div>
    </MainLayout>
</template>
