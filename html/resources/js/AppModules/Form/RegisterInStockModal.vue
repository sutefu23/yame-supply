<script lang="ts" setup>
import Modal from '@/Components/Alert/Modal.vue';
import InputLabel from '@/Components/Input/InputLabel.vue';
import TextInput from '@/Components/Input/TextInput.vue';
import ProducerSelect from '@/AppModules/Input/ProducerSelect.vue';
import WarehouseSelect from '../Input/WarehouseSelect.vue';
import useInStock from '@/hooks/api/useInStock'
import { GetItemData } from '@/hooks/api/useItems';
import { usePage } from '@inertiajs/inertia-vue3';
defineProps<{ show: boolean }>()
const emit = defineEmits(["close", "onSuccess"])

const { props } = usePage<{ Items: GetItemData[] }>()
const items = props.value.Items

const { form, post, InvalidError } = useInStock()
const submit = async () => {
  await post()
  form.reset()
  emit('onSuccess')
}

</script>
<template>
  <Modal button-ok="確定" :show="show" modal-title="在庫入荷" :is-over-screen-height="true" @emit:close="$emit('close')"
    @emit:ok="submit">
    <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 pt-6 gap-8">
      <div class="h-full">
        <InputLabel for="producer">生産所</InputLabel>
        <InvalidError field="produce_user_id" />
        <ProducerSelect v-model="form.produce_user_id"></ProducerSelect>
        <InputLabel>入荷日</InputLabel>
        <InvalidError field="import_date" />
        <TextInput type="date" id="importDate" v-model="form.import_date" />
      </div>
      <div class="h-full">
        <InputLabel for="warehouse">倉庫</InputLabel>
        <InvalidError field="warehouse_id" />
        <WarehouseSelect v-model="form.warehouse_id"></WarehouseSelect>
        <InputLabel for="reason">備考</InputLabel>
        <InvalidError field="reason" />
        <TextInput id="reason" placeholder="備考" v-model="form.reason" />
      </div>
    </div>
    <div class="w-full h-full mb-10">
      <InvalidError field="in_stock_details" />
      <table class="w-full whitespace-nowrap overflow-y-scroll h-96">
        <thead>
          <tr tabindex="0" class="
                  focus:outline-none
                  h-16
                  w-full
                  text-sm
                  leading-none
                  text-gray-800
                  ">
            <th>名称</th>
            <th colspan="5">製材寸法</th>
            <th>数量</th>
          </tr>
        </thead>
        <tbody class="w-full">
          <tr v-for="(item, index) in items" :key="item.id" tabindex="0" class="
              focus:outline-none
              text-gray-800
              bg-white
              hover:bg-indigo-50
              text-center
              border-b border-t border-gray-100
          ">
            <td class="border-r border-l border-gray-200">{{ item.wood_species.name }}</td>
            <td class="border-l border-gray-200">{{ item.length }}</td>
            <td>×</td>
            <td>{{ item.width }}</td>
            <td>×</td>
            <td class="border-r border-gray-200">{{ item.thickness }}</td>
            <td class="border-r border-gray-200">
              <div class="flex items-center justify-center">
                <TextInput name="quantity" type="number" class="w-16" v-if="form"
                  v-model="form.in_stock_details[index].item_quantity">
                </TextInput>
                <div class="h-full">{{ item.unit.name }}</div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Modal>
</template>