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

const internalShow = ref(false);
let resolvePromise;

defineExpose({
    show() {
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

const close = () => {
    emit('close');
    internalShow.value = false;
    resolvePromise(false);
};
</script>
<template>
    <AlertDialog v-model:open="internalShow">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Are you sure absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription>
                    This action cannot be undone. This preset will no longer be
                    accessible by you or others you&apos;ve shared it with.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
                <Button variant="destructive" @click="accept">
                    Agree
                </Button>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>