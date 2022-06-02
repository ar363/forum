<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-pink-600 rounded-md border border-transparent transition cursor-pointer hover:bg-pink-500 active:bg-pink-700 focus:outline-none focus:border-pink-800 focus:ring focus:ring-pink-300 disabled:opacity-25">
        <slot />
    </button>
</template>
