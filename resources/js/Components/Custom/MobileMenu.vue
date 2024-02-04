<script setup>
import { ref } from 'vue'
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet'
import { Button } from '@/Components/ui/button'
import { ScrollArea } from '@/Components/ui/scroll-area'
import { Bars3BottomLeftIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';

const open = ref(false)

const docsConfig = {
  mainNav: [
    {
      title: 'Documentation',
      href: '/docs/introduction',
    },
    {
      title: 'Components',
      href: '/docs/components/accordion',
    },
    {
      title: 'Themes',
      href: '/themes',
    },
    {
      title: 'Examples',
      href: '/examples/dashboard',
    },
    {
      title: 'GitHub',
      href: 'https://github.com/radix-vue/shadcn-vue',
      external: true,
    },
  ],
  sidebarNav: [
    {
      title: 'Getting Started',
      items: [
        {
          title: 'Introduction',
          href: '/docs/introduction',
          items: [],
        },
        {
          title: 'Installation',
          href: '/docs/installation',
          items: [],
        },
        {
          title: 'components.json',
          href: '/docs/components-json',
          items: [],
        },
        {
          title: 'Theming',
          href: '/docs/theming',
          items: [],
        },
        {
          title: 'CLI',
          href: '/docs/cli',
          items: [],
        },
        {
          title: 'Typography',
          href: '/docs/typography',
          items: [],
        },
        {
          title: 'Figma',
          href: '/docs/figma',
          items: [],
        },
        {
          title: 'Changelog',
          href: '/docs/changelog',
          items: [],
        },
        {
          title: 'About',
          href: '/docs/about',
          items: [],
        },
      ],
    },
  ],
}
</script>

<template>
  <Sheet v-model:open="open">
    <SheetTrigger as-child>
      <Button
        variant="ghost"
        class="mr-2 px-2 text-base flex-shrink-0 hover:bg-transparent focus-visible:bg-transparent focus-visible:ring-0 focus-visible:ring-offset-0 md:hidden"
      >
        <Bars3BottomLeftIcon class="h-5 w-5" />
        <span class="sr-only">Toggle Menu</span>
      </Button>
    </SheetTrigger>
    <SheetContent side="left" class="pr-0">
      <Link href="/" class="mr-6 flex items-center space-x-2">
          <svg class="h-6 w-6" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_102_1338)"><path d="M208 128L128 208" stroke="#41B883" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path><path d="M192 40L40 192" stroke="#41B883" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_102_1338"><rect width="256" height="256" fill="white"></rect></clipPath></defs></svg>
          <span class="font-bold">Larashortener</span>
      </Link>
      <ScrollArea class="my-4 h-[calc(100vh-8rem)] pb-10 pl-6">
        <div class="flex flex-col space-y-3">
          <a
            v-for="item in docsConfig.mainNav"
            :key="item.href"
            :href="item.href"
            @click="open = false"
          >
            {{ item.title }}
          </a>
        </div>
        <div class="flex flex-col space-y-2">
          <div v-for="(items, index) in docsConfig.sidebarNav" :key="index" class="flex flex-col space-y-3 pt-6">
            <h4 class="font-medium">
              {{ items.title }}
            </h4>

            <a
              v-for="item in items.items" :key="item.href"
              :href="item.href"
              class="text-muted-foreground"
              @click="open = false"
            >
              {{ item.title }}
            </a>
          </div>
        </div>
      </ScrollArea>
    </SheetContent>
  </Sheet>
</template>