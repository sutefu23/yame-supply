<script lang="ts" setup>
import { ref, onBeforeMount } from 'vue'
import SelectInput from '@/Components/Input/SelectInput.vue';
import useMaster, { WarehouseType } from '@/hooks/api/useMaster';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const warehouses = ref<WarehouseType[]>([])
const { fetch } = useMaster("Warehouse")

onBeforeMount(async () => {
	warehouses.value = await fetch()
})
</script>
<template>
	<SelectInput id="warehouse" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
		:options="warehouses.map(warehouse => ({ key: warehouse.id, name: warehouse.name }))">
	</SelectInput>
</template>