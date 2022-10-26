<script lang="ts" setup>
import { ref, onBeforeMount } from 'vue'
import SelectInput from '@/Components/Input/SelectInput.vue';
import useUser, { GetUserData } from '@/hooks/api/useUsers';

type Props = {
	modelValue: number | string
}
defineProps<Props>();

defineEmits(['update:modelValue']);

const { fetch } = useUser("製材所")
const producers = ref<GetUserData[]>([])

onBeforeMount(async () => {
	producers.value = await fetch()
})

</script>
<template>
	<SelectInput id="producer" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)">
		<option value=""></option>
		<option v-for="producer in producers" :key="producer.id" :value="producer.id">{{ producer.name }}</option>
	</SelectInput>
</template>