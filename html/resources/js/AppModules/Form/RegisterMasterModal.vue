<script lang="ts" setup>
import Modal from '@/Components/Alert/Modal.vue';
import InputLabel from '@/Components/Input/InputLabel.vue';
import TextInput from '@/Components/Input/TextInput.vue';
import useMaster, { MasterType, WarehouseType, masterScheme } from '@/hooks/api/useMaster';
import { onBeforeMount } from 'vue';

const props = defineProps<{ master: MasterType, show: boolean, editId?: WarehouseType["id"], disable?: boolean }>()

const emit = defineEmits(["close", "onSuccess"])

const title = masterScheme[props.master]
const { form, fetch, update, post, InvalidError } = useMaster(props.master)

onBeforeMount(async () => {
  if (props.editId) {
    form.reset()
    const editData = await fetch({ id: props.editId })
    form.id = editData[0].id
    form.name = editData[0].name
  }
})

const submit = async () => {
  props.editId ? await update(props.editId) : await post()
  form.reset()
  emit('onSuccess')
}

</script>
<template>
  <Modal button-ok="確定" :show="show" :modal-title="title" @emit:close="$emit('close')" @emit:ok="submit"
    :disable="disable">
    <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 pt-6 gap-8">
      <div>
        <InputLabel for="id" value="ID" />
        <InvalidError field="id" />
        <TextInput id="id" v-model="form.id" type="text" class="mt-1 block w-full" required autofocus
          autocomplete="id" />
      </div>
      <div>
        <InputLabel for="name" value="名称" />
        <InvalidError field="name" />
        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus
          autocomplete="name" />
      </div>

    </div>
  </Modal>

</template>