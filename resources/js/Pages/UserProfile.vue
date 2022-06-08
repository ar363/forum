<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import { formatRelative } from "date-fns";

defineProps({
  profile: Object,
  stats: Object,
});
</script>

<template>
  <app-layout>
    <template #header>
      <div class="text-xl font-semibold leading-tight text-gray-800">
        Profile
      </div>
    </template>

    <div class="max-w-screen-md mx-auto p-4 py-8">
      <div class="prose">
        <img :src="profile.profile_photo_url" alt="" class="rounded-md" />
        <h1>
          {{ profile.name }}
          &nbsp;&nbsp;
          <span class="text-gray-500 mt-2">[#{{ profile.id }}]</span>
        </h1>
        <ul>
          <li>
            Joined
            {{ formatRelative(new Date(profile.created_at), new Date()) }}
          </li>
          <li>Has started {{ stats.posts }} discussions since joining</li>
          <li>Has made {{ stats.comments }} replies since joining</li>
        </ul>
      </div>
    </div>
  </app-layout>
</template>
