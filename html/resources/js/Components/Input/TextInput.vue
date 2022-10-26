<script setup lang="ts">
import { InputHTMLAttributes, onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

interface InputAttributes extends InputHTMLAttributes {
    hasAttribute : (name: string) => boolean,
    focus : () => void,
}
const input = ref<InputAttributes|null>(null);

onMounted(() => {
    if (input.value && input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>

<template>
    <input class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" :value="modelValue" @input="$emit('update:modelValue', $event?.target?.value)" ref="input">
</template>
