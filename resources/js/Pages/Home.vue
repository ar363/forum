<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import { formatRelative } from 'date-fns';

defineProps({
    latestPosts: Array,
})
</script>

<template>
  <app-layout>
    <section>
      <div
        class="relative items-center px-5 py-8 mx-auto w-full max-w-screen-xl bg-gray-50 md:px-12 lg:px-16 lg:py-12"
        v-if="!$page.props.user"
      >
        <div class="flex mx-auto w-full text-left">
          <div class="inline-flex relative items-center mx-auto align-middle">
            <div class="text-center">
              <h1
                class="max-w-5xl text-4xl font-bold tracking-tighter leading-none text-gray-600 md:text-5xl lg:text-6xl lg:max-w-7xl"
              >
                Welcome to the <br class="block" />
                asdf community forum
              </h1>
              <p
                class="mx-auto mt-4 max-w-xs text-base leading-relaxed text-gray-500 md:max-w-none"
              >
                Look around, share ideas, and connect with other people!
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="text-gray-800 bg-white border-t border-gray-100">
        <div class="px-5 py-8 mx-auto w-full max-w-screen-lg sm:px-8">
          <div class="hidden grid-cols-12 gap-4 p-4 text-sm text-gray-600 border-b border-gray-200 md:grid">
            <div class="col-span-6">Discussion</div>
            <div class="col-span-1">Author</div>
            <div class="col-span-3">Participants</div>
            <div class="col-span-1">Replies</div>
            <div class="col-span-1">Last Active</div>
          </div>

          <div v-for="post in latestPosts" v-bind:key="post.id" class="grid-cols-12 gap-4 p-4 text-sm text-gray-600 border-b border-gray-200 md:grid">
            <Link class="col-span-6 pr-4 text-xl" :href="route('discussion.show', post.id)">{{ post.title }}</Link>
            <div class="col-span-1">
                <img :src="post.author.profile_photo_url"
                    :alt="post.author.name + '#' + post.author.id"
                    class="w-8 h-8 rounded-full" />
            </div>
            <div class="flex flex-wrap col-span-3 gap-2">
                <div class="" v-for="ppt in post.participants.most_part" v-bind:key="ppt.id">
                    <img :src="ppt.profile_photo_url"
                        :alt="ppt.name + '#' + ppt.id"
                        class="w-8 h-8 rounded-full" />
                </div>

                <div class="flex justify-center items-center p-2 h-8 text-gray-700 bg-gray-200 rounded-full" v-if="post.participants.most_part.length <= post.participants.total_count">
                    + {{ post.participants.total_count - post.participants.most_part.length }}
                </div>
            </div>
            <div class="col-span-1 text-lg font-medium">{{ post.comments_count }}</div>
            <div class="col-span-1">{{ formatRelative(new Date(post.last_activity), new Date()) }}</div>
          </div>

        </div>
      </div>
    </section>
  </app-layout>
</template>
