<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/Components/ui/tabs";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from "@/Components/ui/pagination";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    apps: Array,
    current: Object,
    shorts: Object,
});

const navigateToPage = (page) => {
  router.get(route('shorts.index', props.current.ulid), { page });
};
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
                <Tabs :default-value="current.ulid" class="w-full">
                    <TabsList>
                        <TabsTrigger
                            v-for="app in apps"
                            :key="app.ulid"
                            :value="app.ulid"
                        >
                            <Link :href="route('shorts.index', app.ulid)">
                                {{ app.name }}
                            </Link>
                        </TabsTrigger>
                    </TabsList>
                    <TabsContent
                        v-for="app in apps"
                        :key="app.ulid"
                        :value="app.ulid"
                    >
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h2 class="text-2xl font-bold tracking-tight">
                                    {{ app.name }}
                                </h2>
                            </div>
                            <div class="overflow-x-auto">
                                <Table class="w-full">
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead> Code </TableHead>
                                            <TableHead>
                                                Original URL
                                            </TableHead>
                                            <TableHead> View Count </TableHead>
                                            <TableHead>
                                                Last View Date
                                            </TableHead>
                                            <TableHead> Actions </TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        <TableRow
                                            v-for="short in shorts.data"
                                            :key="short.id"
                                        >
                                            <TableCell class="font-medium">
                                                {{ short.code }}
                                            </TableCell>
                                            <TableCell>
                                                {{ short.url }}
                                            </TableCell>
                                            <TableCell>
                                                {{ short.hits }}
                                            </TableCell>
                                            <TableCell v-if="short.last_hit_at">
                                                {{ short.last_hit_at }}
                                            </TableCell>
                                            <TableCell v-else>
                                                <Badge variant="secondary"
                                                    >Never</Badge
                                                >
                                            </TableCell>
                                            <TableCell class="text-right">
                                                <button
                                                    class="text-blue-500 hover:underline"
                                                >
                                                    Edit
                                                </button>
                                                <button
                                                    class="text-red-500 hover:underline"
                                                >
                                                    Delete
                                                </button>
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                </Table>
                                <div class="w-full flex justify-end my-8">
                                  <Pagination
                                    :total="shorts.total"
                                    :items-per-page="shorts.per_page"
                                    :page="shorts.current_page"
                                    show-edges
                                    @update:page="navigateToPage"
                                >
                                    <PaginationList
                                        v-slot="{ items }"
                                        class="flex items-center gap-1"
                                    >
                                        <PaginationFirst />
                                        <PaginationPrev />

                                        <template
                                            v-for="(item, index) in items"
                                        >
                                            <PaginationListItem
                                                v-if="item.type === 'page'"
                                                :key="index"
                                                :value="item.value"
                                                as-child
                                            >
                                                <Button
                                                    class="w-10 h-10 p-0"
                                                    :variant="
                                                        item.value === shorts.current_page
                                                            ? 'default'
                                                            : 'outline'
                                                    "
                                                >
                                                    {{ item.value }}
                                                </Button>
                                            </PaginationListItem>
                                            <PaginationEllipsis
                                                v-else
                                                :key="item.type"
                                                :index="index"
                                            />
                                        </template>
                                        <PaginationNext />
                                        <PaginationLast />
                                    </PaginationList>
                                </Pagination>
                                </div>
                            </div>
                        </div>
                    </TabsContent>
                </Tabs>
            </div>
        </div>
    </MainLayout>
</template>
