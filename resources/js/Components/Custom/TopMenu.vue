<script setup>
import { useDark, useToggle } from '@vueuse/core';
import { cn } from '@/lib/utils'
import { Button } from '@/Components/ui/button'
import { ScrollArea } from '@/Components/ui/scroll-area'
import UserNav from './UserNav.vue';
import MobileMenu from './MobileMenu.vue';
import { Link } from '@inertiajs/vue3';

defineProps()

const isDark = useDark()
const toggleDark = useToggle(isDark)
</script>

<template>
    <header class="sticky z-40 top-0 bg-background/80 backdrop-blur-lg border-b border-border">
        <div class="container flex justify-between h-14 max-w-screen-2xl items-center">
            <MobileMenu />
            <div class="mr-4 hidden md:flex">
                <Link href="/" class="mr-6 flex items-center space-x-2">
                    <svg class="h-6 w-6" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_102_1338)"><path d="M208 128L128 208" stroke="#41B883" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path><path d="M192 40L40 192" stroke="#41B883" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_102_1338"><rect width="256" height="256" fill="white"></rect></clipPath></defs></svg>
                    <span class="font-bold">Larashortener</span>
                </Link>
                <nav class="flex items-center space-x-6 text-sm font-medium">
                    <a href="/docs/components/accordion" class="transition-colors hover:text-foreground/80 text-foreground/60">
                        Components
                    </a>
                </nav>
            </div>
            <div class="flex items-center justify-end space-x-4">
                <div class="flex items-center gap-x-1">
                    <button
                        @click="toggleDark()"
                        class="whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 flex items-center justify-center" aria-label="Toggle dark mode">
                        <svg viewBox="0 0 15 15" width="1.2em" height="1.2em" class="w-[20px] h-5 text-foreground"><path fill="currentColor" fill-rule="evenodd" d="M2.9.5a.4.4 0 0 0-.8 0v.6h-.6a.4.4 0 1 0 0 .8h.6v.6a.4.4 0 1 0 .8 0v-.6h.6a.4.4 0 0 0 0-.8h-.6zm3 3a.4.4 0 1 0-.8 0v.6h-.6a.4.4 0 1 0 0 .8h.6v.6a.4.4 0 1 0 .8 0v-.6h.6a.4.4 0 0 0 0-.8h-.6zm-4 3a.4.4 0 1 0-.8 0v.6H.5a.4.4 0 1 0 0 .8h.6v.6a.4.4 0 0 0 .8 0v-.6h.6a.4.4 0 0 0 0-.8h-.6zM8.544.982l-.298-.04c-.213-.024-.34.224-.217.4A6.57 6.57 0 0 1 9.203 5.1a6.602 6.602 0 0 1-6.243 6.59c-.214.012-.333.264-.183.417a6.8 6.8 0 0 0 .21.206l.072.066l.26.226l.188.148l.121.09l.187.131l.176.115c.12.076.244.149.37.217l.264.135l.26.12l.303.122l.244.086a6.568 6.568 0 0 0 1.103.26l.317.04l.267.02a6.6 6.6 0 0 0 6.943-7.328l-.037-.277a6.557 6.557 0 0 0-.384-1.415l-.113-.268l-.077-.166l-.074-.148a6.602 6.602 0 0 0-.546-.883l-.153-.2l-.199-.24l-.163-.18l-.12-.124l-.16-.158l-.223-.2l-.32-.26l-.245-.177l-.292-.19l-.321-.186l-.328-.165l-.113-.052l-.24-.101l-.276-.104l-.252-.082l-.325-.09l-.265-.06zm1.86 4.318a7.578 7.578 0 0 0-.572-2.894a5.601 5.601 0 1 1-4.748 10.146a7.61 7.61 0 0 0 3.66-2.51a.749.749 0 0 0 1.355-.442a.75.75 0 0 0-.584-.732c.062-.116.122-.235.178-.355A1.25 1.25 0 1 0 10.35 6.2c.034-.295.052-.595.052-.9" clip-rule="evenodd"></path></svg>
                    </button>
                    <UserNav />
                </div>
            </div>
        </div>
    </header>
</template>