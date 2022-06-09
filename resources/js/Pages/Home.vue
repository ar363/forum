<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import PostList from "@/components/PostList.vue";
import Paginate from "@/components/Paginate.vue";

defineProps({
  latestPosts: Object,
});
</script>

<template>
  <app-layout>
    <template #header v-if="latestPosts.current_page > 1">
      <div class="text-xl font-semibold leading-tight text-gray-800">
        Page {{ latestPosts.current_page }}
      </div>
    </template>

    <section class="pb-6">
      <div
        class="mx-auto w-full max-w-screen-md px-8 pt-6 flex justify-end"
        v-if="$page.props.user"
      >
        <Link
          :href="route('discussion.create')"
          class="
            block
            px-4
            py-3
            bg-emerald-700
            rounded-lg
            text-white
            font-medium
          "
          >+ New discussion</Link
        >
      </div>
      <div
        class="
          relative
          items-center
          px-5
          py-8
          mx-auto
          w-full
          max-w-screen-xl
          bg-gray-50
          md:px-12
          lg:px-16 lg:py-12
        "
        v-if="!$page.props.user && latestPosts.current_page === 1"
      >
        <div class="flex mx-auto w-full text-left">
          <div class="inline-flex relative items-center mx-auto align-middle">
            <div class="text-center">
              <h1
                class="
                  max-w-5xl
                  text-4xl
                  font-bold
                  tracking-tighter
                  leading-none
                  text-gray-600
                  md:text-5xl
                  lg:text-6xl lg:max-w-7xl
                "
              >
                Welcome to the <br class="block" />
                asdf community forum
              </h1>
              <p
                class="
                  mx-auto
                  mt-4
                  max-w-xs
                  text-base
                  leading-relaxed
                  text-gray-500
                  md:max-w-none
                "
              >
                Look around, share ideas, and connect with other people!
              </p>
            </div>
          </div>
        </div>
      </div>

      <post-list :posts="latestPosts.data" />

      <div
        class="text-gray-600 text-center px-4"
        v-if="latestPosts.total === 0"
      >
        No discussions here yet...
      </div>
      <paginate
        v-else-if="
          latestPosts.current_page * latestPosts.per_page -
            latestPosts.per_page <=
          latestPosts.total
        "
        :totalCount="latestPosts.total"
        thingName="Discussions"
        :currentPage="latestPosts.current_page"
        :countPerPage="latestPosts.per_page"
        :prevPageUrl="route('home', { page: latestPosts.current_page - 1 })"
        :nextPageUrl="route('home', { page: latestPosts.current_page + 1 })"
      />
      <div class="text-gray-600 text-center px-4" v-else>
        Invalid page number
      </div>
    </section>
  </app-layout>
</template>
