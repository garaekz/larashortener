<script setup>
import { cn } from '@/lib/utils';
import { Button } from '@/Components/ui/button';
import { ScrollArea } from '@/Components/ui/scroll-area';
import { Link } from '@inertiajs/vue3';

defineProps()
</script>

<template>
  <aside
      class="fixed top-5 z-30 -ml-2 hidden h-[calc(100vh-3.6rem)] w-full shrink-0 md:sticky md:block overflow-y-auto"
    >
    <ScrollArea orientation="vertical" class="relative overflow-hidden h-full pr-6 py-2" :type="'auto'">
      <div class="space-y-4 py-4">
        <div class="px-3 py-2">
          <h2 class="mb-2 px-4 text-lg font-semibold tracking-tight">
            Discover
          </h2>
          <div class="space-y-1">
            <Link :href="route('dashboard')">
              <Button :variant="route().current('dashboard') ? 'secondary':'ghost'" class="w-full justify-start">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  class="mr-2 h-4 w-4"
                >
                  <circle cx="12" cy="12" r="10" />
                  <polygon points="10 8 16 12 10 16 10 8" />
                </svg>
                Dashboard
              </Button>
            </Link>
            <Link :href="route('shorts.index')">
              <Button :variant="route().current('shorts.index') ? 'secondary':'ghost'" class="w-full justify-start">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  class="mr-2 h-4 w-4"
                >
                  <rect width="7" height="7" x="3" y="3" rx="1" />
                  <rect width="7" height="7" x="14" y="3" rx="1" />
                  <rect width="7" height="7" x="14" y="14" rx="1" />
                  <rect width="7" height="7" x="3" y="14" rx="1" />
                </svg>
                Shortened URLs
              </Button>
            </Link>
          </div>
        </div>
        <div class="px-3 py-2">
          <h2 class="mb-2 px-4 text-lg font-semibold tracking-tight">
            Developers
          </h2>
          <div class="space-y-1">
            <Link :href="route('apps.index')">
              <Button :variant="route().current('apps.index') ? 'secondary':'ghost'" class="w-full justify-start">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  class="mr-2 h-4 w-4"
                >
                  <path d="M21 15V6" />
                  <path d="M18.5 18a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                  <path d="M12 12H3" />
                  <path d="M16 6H3" />
                  <path d="M12 18H3" />
                </svg>
                API Keys
              </Button>
            </Link>
          </div>
        </div>
      </div>
    </ScrollArea>
  </aside>
</template>