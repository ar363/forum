<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-emerald-600 rounded-md border border-transparent transition cursor-pointer hover:bg-emerald-500 active:bg-emerald-700 focus:outline-none focus:border-emerald-800 focus:ring focus:ring-emerald-300 disabled:opacity-25">
        <slot />
    </button>
</template>
