<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";

import { marked } from "marked";
import { formatRelative } from "date-fns";

defineProps({
  post: Object,
});
</script>


<template>
  <app-layout>
    <div class="mx-auto mt-6 max-w-screen-sm bg-white shadow-xl sm:rounded-lg">
      <div class="p-8 pb-4">
        <p class="mb-2 text-xs font-medium text-gray-500">
          <a href="" class="underline">
            {{ post.author.name + " [#" + post.author.id + "]" }} </a
          >, {{ formatRelative(new Date(post.last_activity), new Date()) }}
        </p>
        <h1 class="text-2xl font-semibold">{{ post.title }}</h1>
        <div class="mt-4 prose" v-html="marked(post.body)"></div>
      </div>
      <div
        class="flex px-8 pt-4 pb-8 space-x-8 bg-gray-50 rounded-lg rounded-t-none"
      >
        <div class="">
          <div
            class="mb-2 text-xs font-bold tracking-wider text-gray-400 uppercase"
          >
            Author
          </div>
          <div class="">
            <div class="">
              <img
                :src="post.author.profile_photo_url"
                :alt="post.author.name + '#' + post.author.id"
                class="w-8 h-8 rounded-full"
              />
            </div>
          </div>
        </div>

        <div class="">
          <div
            class="mb-2 text-xs font-bold tracking-wider text-gray-400 uppercase"
          >
            Participants
          </div>
          <div class="flex space-x-2">
            <div
              class=""
              v-for="ppt in post.participants.most_part"
              v-bind:key="ppt.id"
            >
              <img
                :src="ppt.profile_photo_url"
                :alt="ppt.name + '#' + post.author.id"
                class="w-8 h-8 rounded-full"
              />
            </div>
            <div
              class="flex justify-center items-center px-2 h-8 text-sm text-gray-700 bg-gray-300 rounded-full min-w-12"
              v-if="
                post.participants.most_part.length <=
                post.participants.total_count"
            >
              +
              {{
                post.participants.total_count -
                post.participants.most_part.length
              }}
            </div>
          </div>


        </div>

        <div class="">
            <div
              class="mb-2 text-xs font-bold tracking-wider text-gray-400 uppercase"
            >
              Replies
            </div>
            <div class="">
              <div class="text-xl font-medium text-gray-700">
                {{ post.comments_count }}
              </div>
            </div>
          </div>
      </div>
    </div>
  </app-layout>
</template>
