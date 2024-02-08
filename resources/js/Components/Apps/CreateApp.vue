<script setup>
import { ref } from 'vue';
import * as z from 'zod';
import { useForm } from '@inertiajs/vue3';
import { toTypedSchema } from '@vee-validate/zod';
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/Components/ui/form';

const form = useForm({
  name: '',
  description: '',
});

const formSchema = toTypedSchema(z.object({
  name: z
    .string()
    .min(3, {
      message: 'Name must be at least 3 characters.',
    }),
  description: z.string().optional(),
}))

const isModalOpen = ref(false);

const onSubmit = () => {
  form.post(route('apps.store'), {
    preserveScroll: true,
    onSuccess: () => {
      isModalOpen.value = false;
      form.reset();
    },
    onError: (err) => {
      console.error(err, formSchema);
    },
  });
};
</script>

<template>
  <Dialog :open="isModalOpen" @update:open="isModalOpen = $event">
    <DialogTrigger as-child>
      <Button variant="secondary">
        Generate a new API key
      </Button>
    </DialogTrigger>
    <DialogContent class="sm:max-w-[475px]">
    <Form class="space-y-8" :validation-schema="formSchema" @submit="onSubmit">
      <DialogHeader>
        <DialogTitle>
            API Key
        </DialogTitle>
        <DialogDescription>
          This will generate a new API key for your app. You can revoke the key at any time.
        </DialogDescription>
      </DialogHeader>
      <FormField v-slot="{ componentField }" name="name">
        <FormItem>
          <FormLabel>Name</FormLabel>
          <FormControl>
            <Input v-model="form.name" type="text" v-bind="componentField" />
          </FormControl>
          <FormDescription>
            This is the name of your app. It will be displayed in the dashboard.
          </FormDescription>
          <FormMessage />
          <InputError class="mt-2" :message="form.errors.name" />
        </FormItem>
      </FormField>
      <FormField v-slot="{ componentField }" name="description">
        <FormItem>
          <FormLabel>Description <span class="text-muted-foreground">(optional)</span></FormLabel>
          <FormControl>
            <Input v-model="form.description" type="text" v-bind="componentField" />
          </FormControl>
          <FormDescription>
            An optional description of what you will use the API key for.
          </FormDescription>
          <FormMessage />
          <InputError class="mt-2" :message="form.errors.description" />
        </FormItem>
      </FormField>
      <DialogFooter>
        <Button type="submit">
          Save
        </Button>
      </DialogFooter>
      </Form>
    </DialogContent>
  </Dialog>
</template>