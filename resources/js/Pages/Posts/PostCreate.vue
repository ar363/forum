<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import FInput from "@/components/Input.vue";
import JetButton from "@/Jetstream/Button.vue";

const form = useForm({
  title: null,
  body: null,
  category_id: null,
  tags: "",
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      tags: data.tags
        .split(",")
        .map((x) => x.trim())
        .filter((x) => x !== ""),
    }))
    .submit("post", route("discussion.store"));
};

defineProps({
  categories: Array,
});
</script>


<template>
  <app-layout>
    <div class="p-8 mx-auto max-w-screen-sm">
      <h1 class="text-3xl font-bold">Start a New Discussion</h1>

      <form @submit.prevent="submit">
        <label for="title" class="text-sm block mt-6 mb-2 text-gray-500"
          >Title</label
        >
        <FInput v-model="form.title" id="title" />

        <label for="body" class="text-sm block mt-6 mb-2 text-gray-500"
          >Body</label
        >
        <textarea
          v-model="form.body"
          id="body"
          class="
            block
            px-3
            py-2
            w-full
            h-48
            text-gray-900
            rounded-md
            border border-gray-200
            shadow-sm
            focus:ring
            focus:outline-none
            focus:border-emerald-600
            focus:ring-emerald-600
            focus:ring-opacity-30
          "
        />
        <div class="flex flex-col sm:flex-row mt-6 gap-6 sm:gap-4">
          <div class="flex-1">
            <label for="tags" class="text-sm block mb-2 text-gray-500"
              >Tags
              <div class="text-xs">
                (Separated by commas, Min 1, Max 6)
              </div></label
            >
            <FInput v-model="form.tags" id="tags" />
          </div>
          <div class="flex-1">
            <label for="category_id" class="text-sm block mb-2 text-gray-500"
              >Category
              <div class="text-xs">(Required)</div>
            </label>
            <select
              class="
                block
                w-full
                px-3
                py-2
                text-gray-900
                rounded-md
                border border-gray-200
                shadow-sm
                focus:ring
                focus:outline-none
                focus:border-emerald-600
                focus:ring-emerald-600
                focus:ring-opacity-30
              "
              v-model="form.category_id"
              name="category_id"
              id="category_id"
            >
              <option
                v-for="category in categories"
                v-bind:key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>
        </div>

        <div class="flex justify-end mt-4">
          <JetButton type="submit">Create</JetButton>
        </div>
      </form>
    </div>
  </app-layout>
</template>
