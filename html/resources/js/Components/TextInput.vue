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
    <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
