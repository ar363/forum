<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
  <app-layout>
    <section>
      <div
        class="relative items-center px-5 py-8 mx-auto w-full max-w-7xl bg-gray-50 md:px-12 lg:px-16 lg:py-12"
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
    </section>
  </app-layout>
</template>
