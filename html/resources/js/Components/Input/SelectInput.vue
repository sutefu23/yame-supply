<script setup lang="ts">

type Props = {
    modelValue: number | string,
    options: { key: number | string, name: string }[]
}
defineProps<Props>();

defineEmits(['update:modelValue']);

</script>
  
<template>
    <select :model-value="modelValue"
        class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
        @change="$emit('update:modelValue', ($event.target as HTMLInputElement).value)">
        <option value="" />
        <option v-for="option in options" :key="option.key" :value="option.key" :selected="option.key === modelValue">
            {{ option.name }}
        </option>
    </select>
</template>
  