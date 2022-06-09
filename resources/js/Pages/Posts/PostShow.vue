<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button.vue";

import Avatar from "@/components/Avatar.vue";
import AvatarGroup from "@/components/AvatarGroup.vue";

import { marked } from "marked";
import { formatRelative } from "date-fns";
import { onMounted } from "@vue/runtime-core";

import Paginate from "@/components/Paginate.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

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

const postDeleteForm = useForm();
const commentDeleteForm = useForm();

const postBeingDeleted = ref(false);
const commentBeingDeleted = ref(null);

const deletePost = (postId) => {
  postDeleteForm.submit("delete", route("discussion.destroy", postId));
};

const deleteComment = (commentId) => {
  commentDeleteForm.submit("delete", route("reply.destroy", commentId));
};

onMounted(() => {
  form.post_id = props.post.id;
});
</script>


<template>
  <app-layout>
    <JetConfirmationModal
      :show="postBeingDeleted"
      @close="postBeingDeleted = false"
    >
      <template #title> Delete Post </template>

      <template #content>
        Are you sure you would like to delete this post?
      </template>

      <template #footer>
        <JetSecondaryButton @click="postBeingDeleted = false">
          Cancel
        </JetSecondaryButton>

        <JetDangerButton
          class="ml-3"
          @click="deletePost(post.id)"
          :class="{ 'opacity-25': postDeleteForm.processing }"
          :disabled="postDeleteForm.processing"
        >
          Delete
        </JetDangerButton>
      </template>
    </JetConfirmationModal>

    <JetConfirmationModal
      :show="commentBeingDeleted != null"
      @close="commentBeingDeleted = null"
    >
      <template #title> Delete Comment </template>

      <template #content>
        Are you sure you would like to delete this comment?
      </template>

      <template #footer>
        <JetSecondaryButton @click="commentBeingDeleted = null">
          Cancel
        </JetSecondaryButton>

        <JetDangerButton
          class="ml-3"
          @click="deleteComment(commentBeingDeleted)"
          :class="{ 'opacity-25': commentDeleteForm.processing }"
          :disabled="commentDeleteForm.processing"
        >
          Delete
        </JetDangerButton>
      </template>
    </JetConfirmationModal>

    <template #header>
      <div class="text-xl font-semibold leading-tight text-gray-800">
        Discussion
        <span v-if="comments.current_page > 1">
          | Page {{ comments.current_page }}
        </span>
      </div>
    </template>

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
        v-if="commentDeleteForm.wasSuccessful"
      >
        Successfully deleted comment!
      </div>

      <div
        class="mx-auto max-w-screen-sm bg-white shadow-xl sm:rounded-lg"
        v-if="comments.current_page === 1"
      >
        <div class="p-8 pb-4">
          <p
            class="
              mb-2
              text-xs
              font-medium
              text-gray-500
              flex
              items-start
              sm:items-center
              justify-between
              flex-col
              sm:flex-row
              space-y-2
              pb-3
              sm:pb-0 sm:space-y-0
            "
          >
            <span>
              <a href="" class="underline">
                {{ post.author.name + " [#" + post.author.id + "]" }} </a
              >, {{ formatRelative(new Date(post.created_at), new Date()) }}
            </span>
            <span v-if="$page.props.user.id === post.author.id">
              <button @click="postBeingDeleted = true">Delete</button>
            </span>
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
              Category
            </div>
            <a
              class="text-sm text-gray-700"
              :href="route('category', post.category.slug)"
              >{{ post.category.name }}</a
            >
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
            aria-label="Add a reply"
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
        <p
          class="
            mb-2
            text-xs
            font-medium
            text-gray-500
            flex
            items-start
            sm:items-center
            justify-between
            flex-col
            sm:flex-row
            space-y-2
            pb-3
            sm:pb-0 sm:space-y-0
          "
        >
          <span>
            <a href="" class="underline">
              {{ comment.author.name + " [#" + comment.author.id + "]" }} </a
            >, {{ formatRelative(new Date(comment.created_at), new Date()) }}
          </span>
          <span v-if="$page.props.user.id === comment.author.id">
            <button @click="commentBeingDeleted = comment.id">Delete</button>
          </span>
        </p>
        <div class="prose mt-4" v-html="marked(comment.body)"></div>
      </div>

      <div class="mx-auto mt-6 max-w-screen-sm sm:rounded-lg p-8">
        <div
          class="text-gray-600 text-center px-4"
          v-if="comments.total === 0 && comments.current_page === 1"
        >
          No discussions here yet...
        </div>
        <paginate
          v-else-if="
            comments.current_page * comments.per_page - comments.per_page <=
            comments.total
          "
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
        <div class="text-gray-600 text-center px-4" v-else>
          Invalid page number
        </div>
      </div>
    </div>
  </app-layout>
</template>
