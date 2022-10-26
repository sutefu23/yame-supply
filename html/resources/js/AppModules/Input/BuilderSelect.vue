<script lang="ts" setup>
import { ref, onBeforeMount } from 'vue'
import SelectInput from '@/Components/Input/SelectInput.vue';
import useUser, { GetUserData } from '@/hooks/api/useUsers';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const builders = ref<GetUserData[]>([])
const { fetch } = useUser("工務店")

onBeforeMount(async () => {
  builders.value = await fetch()
})
</script>
<template>
  <SelectInput id="builder" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)">
    <option value="" />
    <option v-for="builder in builders" :key="builder.id" :value="builder.id">
      {{ builder.name }}
    </option>
  </SelectInput>
</template>