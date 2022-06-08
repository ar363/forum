<script setup>
defineProps({
  currentPage: Number,
  countPerPage: Number,
  totalCount: Number,
  thingName: String,
  prevPageUrl: String,
  nextPageUrl: String,
});
</script>


<template>
  <div class="flex flex-col items-center">
    <span class="text-sm text-gray-700">
      Showing
      <span class="font-semibold text-gray-900">{{
        countPerPage * currentPage - countPerPage + 1
      }}</span>
      to
      <span class="font-semibold text-gray-900">{{
        countPerPage * currentPage > totalCount
          ? totalCount
          : countPerPage * currentPage
      }}</span>
      of
      <span class="font-semibold text-gray-900">{{ totalCount }}</span>
      {{ thingName }}
    </span>
    <div class="inline-flex mt-2 xs:mt-0">
      <a
        :href="prevPageUrl"
        class="
          inline-flex
          items-center
          py-2
          px-4
          text-sm
          font-medium
          text-white
          bg-gray-800
          rounded-l
          hover:bg-gray-900
          disabled:opacity-60 disabled:cursor-not-allowed
        "
        :class="{ 'rounded-r': countPerPage * currentPage >= totalCount }"
        v-if="currentPage !== 1"
      >
        <svg
          class="mr-2 w-5 h-5"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
        Prev
      </a>
      <a
        :href="nextPageUrl"
        class="
          inline-flex
          items-center
          py-2
          px-4
          text-sm
          font-medium
          text-white
          bg-gray-800
          rounded-r
          border-0 border-l border-gray-700
          hover:bg-gray-900
          disabled:opacity-60 disabled:cursor-not-allowed
        "
        :class="{ 'rounded-l': currentPage === 1 }"
        v-if="countPerPage * currentPage < totalCount"
      >
        Next
        <svg
          class="ml-2 w-5 h-5"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </a>
    </div>
  </div>
</template>
