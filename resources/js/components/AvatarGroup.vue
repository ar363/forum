<script setup>
import Avatar from "@/components/Avatar.vue";

defineProps({
  totalUserCount: Number,
  displayUsers: Object,
});
</script>


<template>
  <div class="flex -space-x-4">
    <Avatar :user="user" v-for="user in displayUsers" v-bind:key="user.id" />
    <div
      v-if="displayUsers.length < totalUserCount"
      class="
        flex
        items-center
        justify-center
        w-10
        h-10
        text-xs
        font-medium
        text-white
        bg-gray-700
        border-2 border-white
        rounded-full
      "
    >
      +{{ totalUserCount - displayUsers.length }}
    </div>

    <div class="" v-if="totalUserCount - displayUsers.length === 0">-</div>
  </div>
</template>
