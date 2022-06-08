<script setup>
defineProps({
  user: Object,
});
</script>

<template>
  <a :href="route('profile', user.id)">
    <img
      class="w-10 h-10 border-2 border-white rounded-full"
      :src="user.profile_photo_url"
      :alt="user.name + '#' + user.id"
    />
  </a>
</template>
