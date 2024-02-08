<script setup>
import { ref } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/Components/ui/tabs";

defineProps({
    apps: Array,
});
</script>
<template>
    <MainLayout title="Dashboard">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Shorts
            </h2>
        </template>

        <div class="space-y-6 py-6 md:p-10 pb-16 md:block">
            <div class="space-y-0.5">
                <h2 class="text-2xl font-bold tracking-tight">Shorts</h2>
                <p class="text-muted-foreground">Manage your shortened URLs.</p>
            </div>
            <div>
                <Tabs :default-value="apps[0].ulid" class="w-[400px]">
                    <TabsList>
                        <TabsTrigger
                            v-for="app in apps"
                            :key="app.ulid"
                            :value="app.ulid"
                        >
                            {{ app.name }}
                        </TabsTrigger>
                    </TabsList>
                    <TabsContent v-for="app in apps" :key="app.ulid" :value="app.ulid">
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h2 class="text-2xl font-bold tracking-tight">
                                    {{ app.name }}
                                </h2>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Short URL</th>
                                            <th class="text-left">Original URL</th>
                                            <th class="text-left">Created At</th>
                                            <th class="text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="short in app.shorts" :key="short.id">
                                            <td class="text-left">{{ short.short_url }}</td>
                                            <td class="text-left">{{ short.original_url }}</td>
                                            <td class="text-left">{{ short.created_at }}</td>
                                            <td class="text-left">
                                                <a
                                                    :href="route('shorts.edit', [app.ulid, short.id])"
                                                    class="text-blue-500 hover:underline"
                                                >
                                                    Edit
                                                </a>
                                                <a
                                                    :href="route('shorts.show', [app.ulid, short.id])"
                                                    class="text-blue-500 hover:underline"
                                                >
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </TabsContent>
                </Tabs>
            </div>
        </div>
    </MainLayout>
</template>
