<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";


const form = useForm({
  title: null,
  body: null,
  category: null,
  tags: "",
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      tags: data.tags.split(',').map(x=>x.trim()).filter(x=>x!==""),
    }))
    .submit('post', route("post.store"));
};

defineProps({
    categories: Array,
})
</script>


<template>
    <app-layout>
        <div class="p-8 mx-auto max-w-screen-sm">
            <h1 class="text-3xl font-bold">New Post</h1>

            <form @submit.prevent="submit">
                <label for="title" class="block mt-6 text-gray-700">Title</label>
                <JetInput v-model="form.title" id="title" class="block px-3 py-2 w-full border border-gray-300 shadow-inner focus:outline-none focus:border-emerald-600 focus:ring-emerald-600 focus:ring-opacity-30" />

                <label for="body" class="block mt-6 text-gray-700">Body</label>
                <textarea v-model="form.body" id="body" class="block px-3 py-2 w-full h-48 text-gray-900 rounded-md border border-gray-300 shadow-inner focus:ring focus:outline-none focus:border-emerald-600 focus:ring-emerald-600 focus:ring-opacity-30" />

                <label for="category" class="block mt-6 text-gray-700">Category</label>
                <select class="block w-full max-w-[160px] px-3 py-2 text-gray-900 rounded-md border border-gray-300 shadow-inner focus:ring focus:outline-none focus:border-emerald-600 focus:ring-emerald-600 focus:ring-opacity-30" v-model="form.category" name="category" id="category">
                    <option v-for="category in categories" v-bind:key="category.id" :value="category.id">{{ category.name }}</option>
                </select>

                <label for="tags" class="block mt-6 text-gray-700">Tags (Separated by commas)</label>
                <JetInput v-model="form.tags" id="tags" class="block px-3 py-2 w-full border border-gray-300 shadow-inner focus:outline-none focus:border-emerald-600 focus:ring-emerald-600 focus:ring-opacity-30" />

                <div class="flex justify-end mt-4">
                    <JetButton type="submit">Create</JetButton>
                </div>
            </form>
        </div>
    </app-layout>
</template>
