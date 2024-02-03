<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import TopMenu from '@/Components/Custom/TopMenu.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import UserNav from '@/Components/Custom/UserNav.vue';
import SideMenu from '@/Components/Custom/SideMenu.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
<Head :title="title" />

<Banner />
<TopMenu />
<div class="flex-1 bg-background">
    <div class="container max-w-screen-2xl grid lg:grid-cols-5">
        <SideMenu />
        <div class="col-span-3 lg:col-span-4 lg:border-l bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</div>
</template>
