<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="text-gray-900 rounded-md border-gray-300 shadow-sm focus:border-gray-400 focus:ring focus:ring-gray-300 focus:ring-opacity-50"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
