<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";

import Avatar from "@/components/Avatar.vue";
import AvatarGroup from "@/components/AvatarGroup.vue";

import { marked } from "marked";
import { formatRelative } from "date-fns";
import { onMounted } from "@vue/runtime-core";

import Paginate from "@/components/Paginate.vue";

const form = useForm({
  body: null,
  post_id: null,
});

const submit = () => {
  form.submit("post", route("reply.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};

const props = defineProps({
  post: Object,
  comments: Object,
});

onMounted(() => {
  form.post_id = props.post.id;
});
</script>


<template>
  <app-layout>
    <div class="py-6">
      <div
        class="
          mx-auto
          my-6
          max-w-screen-sm
          bg-green-900
          text-white
          font-bold
          shadow-xl
          sm:rounded-lg
          p-8
        "
        v-if="form.wasSuccessful"
      >
        Successfully added comment!
      </div>
      <div class="mx-auto max-w-screen-sm bg-white shadow-xl sm:rounded-lg">
        <div class="p-8 pb-4">
          <p class="mb-2 text-xs font-medium text-gray-500">
            <a href="" class="underline">
              {{ post.author.name + " [#" + post.author.id + "]" }} </a
            >, {{ formatRelative(new Date(post.created_at), new Date()) }}
          </p>
          <h1 class="text-2xl font-semibold">{{ post.title }}</h1>
          <div class="mt-4 prose" v-html="marked(post.body)"></div>
        </div>
        <div class="flex gap-4 sm:gap-6 mt-2 flex-wrap p-8 bg-gray-50">
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
            <span class="font-medium text-2xl">{{ post.comments_count }}</span>
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
        </div>
      </div>

      <div
        class="
          mx-auto
          mt-6
          max-w-screen-sm
          bg-white
          shadow-xl
          sm:rounded-lg
          p-8
        "
      >
        <div class="text-xl font-bold mb-4 text-gray-800">
          Your thoughts about this?
        </div>
        <form @submit.prevent="submit">
          <textarea
            required
            name=""
            id=""
            class="
              block
              px-3
              py-2
              w-full
              h-48
              text-gray-900
              rounded-md
              border border-gray-200
              shadow-sm
              focus:ring
              focus:outline-none
              focus:border-emerald-600
              focus:ring-emerald-600
              focus:ring-opacity-30
            "
            v-model="form.body"
          ></textarea>
          <div class="flex justify-end mt-4">
            <jet-button
              type="submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              >Add to the discussion</jet-button
            >
          </div>
        </form>
      </div>

      <div
        class="
          mx-auto
          mt-6
          max-w-screen-sm
          bg-white
          shadow-xl
          sm:rounded-lg
          p-8
        "
        v-for="comment in comments.data"
        v-bind:key="comment.id"
      >
        <p class="mb-2 text-xs font-medium text-gray-500">
          <a href="" class="underline">
            {{ comment.author.name + " [#" + comment.author.id + "]" }} </a
          >, {{ formatRelative(new Date(comment.created_at), new Date()) }}
        </p>
        <div class="prose mt-4" v-html="marked(comment.body)"></div>
      </div>

      <div class="mx-auto mt-6 max-w-screen-sm sm:rounded-lg p-8">
        <paginate
          :totalCount="comments.total"
          thingName="Comments"
          :currentPage="comments.current_page"
          :countPerPage="comments.per_page"
          :prevPageUrl="
            route('discussion.show', {
              discussion: post.id,
              page: comments.current_page - 1,
            })
          "
          :nextPageUrl="
            route('discussion.show', {
              discussion: post.id,
              page: comments.current_page + 1,
            })
          "
        />
      </div>
    </div>
  </app-layout>
</template>
