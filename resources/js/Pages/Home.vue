<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
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
          <div class="hidden grid-cols-8 gap-4 p-4 text-sm text-gray-600 border-b border-gray-200 md:grid">
            <div class="col-span-4">Post</div>
            <div class="col-span-1">Author</div>
            <div class="col-span-1">Participants</div>
            <div class="col-span-1">Comments</div>
            <div class="col-span-1">Last Active</div>
          </div>
        </div>
      </div>
    </section>
  </app-layout>
</template>
