<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <MainLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="border-b">
            <div class="flex h-16 items-center px-4">
                <MainNav class="mx-6" />
                <div class="ml-auto flex items-center space-x-4">
                <Search />
                <UserNav />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </MainLayout>
</template>
