<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
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
            <div
              class="flex gap-2 justify-center mx-auto mt-6 w-full max-w-2xl"
            >
              <div class="mt-3 rounded-lg sm:mt-0">
                <Link :href="route('register')"
                  class="block px-4 py-3 text-base font-medium text-center text-white bg-pink-700 rounded-lg lg:px-7 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
                >
                  Join Now
                </Link>
              </div>
              <div class="mt-3 rounded-lg sm:mt-0">
                <Link :href="route('login')"
                  class="block px-4 py-3 text-base font-medium text-center text-pink-800 bg-pink-100 rounded-lg lg:px-7 hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300"
                >
                  Log In
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
