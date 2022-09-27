<script setup lang="ts">
defineProps(['value']);
</script>

<template>
    <label class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
