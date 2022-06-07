<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import Avatar from "@/components/Avatar.vue";
import AvatarGroup from "@/components/AvatarGroup.vue";

import { formatRelative } from "date-fns";

defineProps({
  latestPosts: Array,
});
</script>

<template>
  <app-layout>
    <section>
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
        v-if="!$page.props.user"
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

      <div class="text-gray-800 border-t border-gray-100">
        <div class="px-5 py-8 mx-auto w-full max-w-screen-md sm:px-8">
          <div
            v-for="post in latestPosts"
            v-bind:key="post.id"
            class="shadow-md rounded-md bg-white mb-4 p-8"
          >
            <Link
              class="text-xl font-bold"
              :href="route('discussion.show', post.id)"
              >{{ post.title }}</Link
            >
            <div class="flex gap-4 sm:gap-8 mt-6 flex-wrap">
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
                  Author
                </div>
                <avatar :user="post.author" />
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
                <span class="font-medium text-2xl">{{
                  post.comments_count
                }}</span>
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
                  Started at
                </div>
                <span class="text-sm text-gray-700">
                  {{ formatRelative(new Date(post.created_at), new Date()) }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!--
        <div class="px-5 py-8 mx-auto w-full max-w-screen-lg sm:px-8">
          <div
            class="
              hidden
              grid-cols-12
              gap-4
              p-4
              text-sm text-gray-600
              border-b border-gray-200
              md:grid
            "
          >
            <div class="col-span-6">Discussion</div>
            <div class="col-span-1">Author</div>
            <div class="col-span-3">Participants</div>
            <div class="col-span-1">Replies</div>
            <div class="col-span-1">Last Active</div>
          </div>

          <div
            v-for="post in latestPosts"
            v-bind:key="post.id"
            class="
              grid-cols-12
              gap-4
              p-4
              text-sm text-gray-600
              border-b border-gray-200
              md:grid
            "
          >
            <Link
              class="col-span-6 pr-4 text-xl"
              :href="route('discussion.show', post.id)"
              >{{ post.title }}</Link
            >
            <div class="col-span-1">
              <avatar :user="post.author" />
            </div>
            <div class="flex flex-wrap col-span-3 gap-2">
              <avatar-group
                :totalUserCount="post.participants.total_count"
                :displayUsers="post.participants.most_part"
              />
            </div>
            <div class="col-span-1 text-lg font-medium">
              {{ post.comments_count }}
            </div>
            <div class="col-span-1">
              {{ formatRelative(new Date(post.last_activity), new Date()) }}
            </div>
          </div>
        </div>-->
      </div>
    </section>
  </app-layout>
</template>
