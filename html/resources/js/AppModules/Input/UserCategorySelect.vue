<script lang="ts" setup>
import { ref, onBeforeMount } from 'vue'
import SelectInput from '@/Components/Input/SelectInput.vue';
import useMaster, { UserCategoryType } from '@/hooks/api/useMaster';

type Props = {
  modelValue: number | string
}
defineProps<Props>();

defineEmits(['update:modelValue']);

const { fetch } = useMaster("UserCategory")
const userCategories = ref<UserCategoryType[]>([])

onBeforeMount(async () => {
  userCategories.value = await fetch()
})

</script>
<template>
  <SelectInput id="userCategory" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
    :options="userCategories.map(userCategory => ({ key: userCategory.id, name: userCategory.name }))">
  </SelectInput>
</template>