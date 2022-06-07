<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";

import Avatar from "@/components/Avatar.vue";
import AvatarGroup from "@/components/AvatarGroup.vue";

import { marked } from "marked";
import { formatRelative } from "date-fns";

defineProps({
  post: Object,
  comments: Array,
});
</script>


<template>
  <app-layout>
    <div class="py-6">
      <div class="mx-auto max-w-screen-sm bg-white shadow-xl sm:rounded-lg">
        <div class="p-8 pb-4">
          <p class="mb-2 text-xs font-medium text-gray-500">
            <a href="" class="underline">
              {{ post.author.name + " [#" + post.author.id + "]" }} </a
            >, {{ formatRelative(new Date(post.created_at), new Date()) }}
          </p>
          <h1 class="text-2xl font-semibold">{{ post.title }}</h1>
          <div class="mt-4 prose" v-html="marked(post.body)"></div>
        </div>
        <div class="flex gap-4 sm:gap-6 mt-2 flex-wrap p-8 bg-gray-50">
          <div class="">
            <div
              class="
                text-gray-500
                tracking-wider
                uppercase
                text-xs
                font-medium
                sm:mb-2
              "
            >
              Participants
            </div>
            <avatar-group
              :totalUserCount="post.participants.total_count"
              :displayUsers="post.participants.most_part"
            />
          </div>

          <div class="">
            <div
              class="
                text-gray-500
                tracking-wider
                uppercase
                text-xs
                font-medium
                sm:mb-2
              "
            >
              Replies
            </div>
            <span class="font-medium text-2xl">{{ post.comments_count }}</span>
          </div>

          <div class="">
            <div
              class="
                text-gray-500
                tracking-wider
                uppercase
                text-xs
                font-medium
                sm:mb-2
              "
            >
              Last Active
            </div>
            <span class="text-sm text-gray-700">{{
              formatRelative(new Date(post.last_activity), new Date())
            }}</span>
          </div>
        </div>
      </div>

      <div
        class="
          mx-auto
          mt-6
          max-w-screen-sm
          bg-white
          shadow-xl
          sm:rounded-lg
          p-8
        "
        v-for="comment in comments.data"
        v-bind:key="comment.id"
      >
        <p class="mb-2 text-xs font-medium text-gray-500">
          <a href="" class="underline">
            {{ comment.author.name + " [#" + comment.author.id + "]" }} </a
          >, {{ formatRelative(new Date(comment.created_at), new Date()) }}
        </p>
        <div class="prose mt-4" v-html="marked(comment.body)"></div>
      </div>

      <div
        class="
          mx-auto
          mt-6
          max-w-screen-sm
          bg-white
          shadow-xl
          sm:rounded-lg
          p-8
        "
      >
        <div class="text-xl font-bold mb-4 text-gray-800">
          Have something to say?
        </div>
        <jet-button>Add to the discussion</jet-button>
      </div>

      <div
        class="
          mx-auto
          mt-6
          max-w-screen-sm
          bg-white
          shadow-xl
          sm:rounded-lg
          p-8
        "
      >
        TODO: pagination
      </div>
    </div>
  </app-layout>
</template>
