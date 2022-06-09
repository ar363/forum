<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
  user: Object,
});
</script>

<template>
  <Link :href="route('profile', user.id)">
    <img
      class="w-10 h-10 border-2 border-white rounded-full"
      :src="user.profile_photo_url"
      :alt="user.name + '#' + user.id"
    />
  </Link>
</template>
