<script setup lang="ts">
import { computed } from 'vue';
import { InStockData, InvalidError } from '@/hooks/api/useInStock';

const props = defineProps<{ message?: string | string[], errors?: InvalidError["data"]["errors"], field?: keyof InStockData }>();

const messages = computed((() => props.errors && props.field ? props.errors[props.field] : ""))
</script>

<template>
    <div>
        <p class="text-sm text-red-600" v-if="Array.isArray(messages)">
            <span v-for="(mes, index) in messages" :key="index">
                {{ mes }}
            </span>
        </p>
        <p class="text-sm text-red-600" v-else>
            {{ message }}
        </p>

    </div>
</template>
