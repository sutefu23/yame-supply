<script lang="ts" setup>
import Modal from '@/Components/Alert/Modal.vue';
import InputLabel from '@/Components/Input/InputLabel.vue';
import TextInput from '@/Components/Input/TextInput.vue';
import BuilderSelect from '@/AppModules/Input/BuilderSelect.vue';
import useBuildingInfo, { BuildingInfoData, GetBuilingInfoData } from '@/hooks/api/useBuildingInfo'
import { GetItemData } from '@/hooks/api/useItems';
import { usePage } from '@inertiajs/inertia-vue3';
import { onBeforeMount } from 'vue';
import dayjs from 'dayjs';

const props = defineProps<{ show: boolean, editId?: GetBuilingInfoData["id"], disable?: boolean }>()

const emit = defineEmits(["close", "onSuccess", "onTransport"])

const page = usePage<{ Items: GetItemData[] }>()
const items = page.props.value.Items

const { form, fetch, update, post, InvalidError } = useBuildingInfo()

const title = !props.editId ? "現場情報登録" : "現場情報確認編集"

onBeforeMount(async () => {
  if (props.editId) {
    form.reset()
    const editData = await fetch({ id: props.editId })
    const formData: Omit<BuildingInfoData, "id"> = {//プロパティの詰め替えに型ガードを生かす為に一度置き換えています
      builder_user_id: editData[0].builder_user_id,
      field_name: editData[0].field_name,
      is_exported: editData[0].is_exported,
      export_expected_date: dayjs(editData[0].export_expected_date).format('YYYY-MM-DD'),
      building_info_details: editData[0].building_info_details
    }
    form.builder_user_id = formData.builder_user_id
    form.field_name = formData.field_name
    form.is_exported = formData.is_exported
    form.export_expected_date = formData.export_expected_date
    form.building_info_details = formData.building_info_details
  }
})

const transport = () => {
  if (confirm("この棟情報を出荷情報にコピーします。\n（出荷確定後は棟情報を編集できなくなります）")) {
    emit('onTransport')
  }
}

const submit = async () => {
  props.editId ? await update(props.editId) : await post()
  form.reset()
  emit('onSuccess')
}

</script>
<template>
  <Modal :button-ok="props.editId ? '情報変更' : '情報登録'" :show="show" :modal-title="title" :is-over-screen-height="true"
    @emit:close="$emit('close')" @emit:ok="submit" :disable="disable">
    <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 pt-6 gap-8">
      <div class="h-full">
        <InputLabel for="field_name">現場名</InputLabel>
        <InvalidError field="field_name" />
        <TextInput :disabled="disable" id="field_name" placeholder="現場名" v-model="form.field_name" />
        <InputLabel for="producer">工務店</InputLabel>
        <InvalidError field="builder_user_id" />
        <BuilderSelect :disabled="disable" v-model="form.builder_user_id"></BuilderSelect>
      </div>
      <div class="h-full">
        <InputLabel>出荷予定日</InputLabel>
        <InvalidError field="export_expected_date" />
        <TextInput :disabled="disable" type="date" id="importDate" v-model="form.export_expected_date" />
        <div v-if="editId" class="text-center pt-8">
          <button v-if="!form.is_exported"
            class="focus:outline-none transition duration-150 ease-in-out hover:bg-red-400 bg-red-500 rounded text-white px-8 py-2 text-sm"
            @click="transport">出荷登録</button>
          <button v-else
            class="focus:outline-none transition duration-150 ease-in-out bg-blue-300 rounded text-white px-8 py-2 text-sm"
            :disabled="true">出荷確定済
          </button>
        </div>
      </div>
    </div>
    <div class="w-full h-full mb-10">
      <InvalidError field="building_info_details" />
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
        <tbody v-if="form.building_info_details" class="w-full">
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
                <TextInput :disabled="disable" name="quantity" type="number" class="w-16" v-if="form"
                  v-model="form.building_info_details[index].item_quantity">
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