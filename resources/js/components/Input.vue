<script setup>
import { onMounted, ref } from "vue";

defineProps({
  modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    ref="input"
    class="
      block
      px-3
      py-2
      w-full
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
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
