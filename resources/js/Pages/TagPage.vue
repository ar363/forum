<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import PostList from "@/components/PostList.vue";
import Paginate from "@/components/Paginate.vue";

defineProps({
  posts: Object,
  tag: String,
});
</script>

<template>
  <app-layout>
    <template #header>
      <div class="text-xl font-semibold leading-tight text-gray-800">
        Posts tagged "{{ tag }}"
        <span v-if="posts.current_page > 1">
          | Page {{ posts.current_page }}
        </span>
      </div>
    </template>

    <section class="pb-6">
      <post-list :posts="posts.data" />

      <div class="text-gray-600 text-center px-4" v-if="posts.total === 0">
        No discussions here yet...
      </div>
      <paginate
        v-else-if="
          posts.current_page * posts.per_page - posts.per_page <= posts.total
        "
        :totalCount="posts.total"
        thingName="Discussions"
        :currentPage="posts.current_page"
        :countPerPage="posts.per_page"
        :prevPageUrl="route('home', { page: posts.current_page - 1 })"
        :nextPageUrl="route('home', { page: posts.current_page + 1 })"
      />
      <div class="text-gray-600 text-center px-4" v-else>
        Invalid page number
      </div>
    </section>
  </app-layout>
</template>
