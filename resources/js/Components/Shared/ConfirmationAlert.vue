<script setup>
import { ref } from 'vue';
import {
    AlertDialog,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/Components/ui/alert-dialog';
import { Button } from '@/Components/ui/button';

const options = ref({
    title: '',
    description: '',
    buttonText: '',
});

const internalShow = ref(false);
let resolvePromise;

defineExpose({
    show(config) {
        options.value = config;

        internalShow.value = true;
        return new Promise((resolve) => {
            resolvePromise = resolve;
        });
    }
});

const emit = defineEmits(['accept', 'close']);

const accept = () => {
    emit('accept');
    internalShow.value = false;
    resolvePromise(true);
};
</script>
<template>
    <AlertDialog v-model:open="internalShow">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>
                    {{ options.title }}
                </AlertDialogTitle>
                <AlertDialogDescription>
                    {{ options.description }}
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
                <Button variant="destructive" @click="accept">
                    {{ options.buttonText }}
                </Button>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>