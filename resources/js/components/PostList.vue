<script setup>
import { formatRelative } from "date-fns";

import { Link } from "@inertiajs/inertia-vue3";

import Avatar from "@/components/Avatar.vue";
import AvatarGroup from "@/components/AvatarGroup.vue";

defineProps({
  posts: Array,
});
</script>


<template>
  <div class="text-gray-800 border-t border-gray-100">
    <div class="px-5 py-8 mx-auto w-full max-w-screen-md sm:px-8">
      <div
        v-for="post in posts"
        v-bind:key="post.id"
        class="shadow-md rounded-md bg-white mb-4 p-8"
      >
        <Link
          class="text-xl font-bold"
          :href="route('discussion.show', post.id)"
          >{{ post.title }}</Link
        >
        <div class="mt-6 grid grid-cols-5 sm:grid-cols-10 gap-6">
          <div class="col-span-2">
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
              Author
            </div>
            <avatar :user="post.author" />
          </div>
          <div class="col-span-3">
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

          <div class="col-span-2">
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

          <div class="col-span-3">
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
        <div class="mt-4 border-t pt-2 flex">
          <div class="w-full">
            <span
              class="
                text-gray-500
                tracking-wider
                uppercase
                text-xs
                font-medium
                sm:mb-2
              "
            >
              Category:
            </span>
            <Link
              class="text-sm font-medium text-gray-700"
              :href="route('category', post.category.slug)"
            >
              {{ post.category.name }}
            </Link>
          </div>
          <div class="w-full">
            <span
              class="
                text-gray-500
                tracking-wider
                uppercase
                text-xs
                font-medium
                sm:mb-2
              "
            >
              Tags:
            </span>
            <span class="text-sm">
              <Link
                :href="route('tag', tag.slug.en)"
                v-for="(tag, idx) in post.tags"
                v-bind:key="tag.slug.en"
              >
                <span class="" v-if="post.tags.length - 1 !== idx">
                  {{ tag.name.en }},
                </span>
                <span class="" v-else>
                  {{ tag.name.en }}
                </span>
              </Link>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
