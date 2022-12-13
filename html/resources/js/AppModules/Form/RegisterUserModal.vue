<script lang="ts" setup>
import Modal from '@/Components/Alert/Modal.vue';
import InputLabel from '@/Components/Input/InputLabel.vue';
import TextInput from '@/Components/Input/TextInput.vue';
import UserCategorySelect from '@/AppModules/Input/UserCategorySelect.vue'
import { GetBuilingInfoData } from '@/hooks/api/useBuildingInfo'
import useUser from '@/hooks/api/useUsers';
import { onBeforeMount } from 'vue';

const props = defineProps<{ show: boolean, editId?: GetBuilingInfoData["id"], disable?: boolean }>()

const emit = defineEmits(["close", "onSuccess"])


const { form, fetch, update, post, InvalidError } = useUser()

onBeforeMount(async () => {
  if (props.editId) {
    form.reset()
    const editData = await fetch({ id: props.editId })
    form.id = editData[0].id
    form.user_category_id = editData[0].user_category_id
    form.name = editData[0].name
    form.email = editData[0].email
  }
})

const submit = async () => {
  props.editId ? await update(props.editId) : await post()
  form.reset()
  emit('onSuccess')
}

</script>
<template>
  <Modal button-ok="確定" :show="show" modal-title="ユーザー" @emit:close="$emit('close')" @emit:ok="submit"
    :disable="disable">
    <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 pt-6 gap-8">
      <div>
        <InputLabel for="name" value="名称" />
        <InvalidError field="name" />
        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus
          autocomplete="name" />
      </div>

      <div>
        <InputLabel for="user_category_id" value="カテゴリー" />
        <InvalidError field="user_category_id" />
        <UserCategorySelect id="user_category_id" v-model="form.user_category_id" type="user_category_id"
          class="mt-1 block w-full" required autocomplete="username" />
      </div>

      <div>
        <InputLabel for="email" value="Email" />
        <InvalidError field="email" />
        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
          autocomplete="username" />
      </div>

      <div>

      </div>

      <div class="mb-8">
        <InputLabel for="password" value="パスワード" />
        <InvalidError field="password" />
        <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
          autocomplete="new-password" />
      </div>
      <div>
        <InputLabel for="password_confirmation" value="パスワード確認" />
        <InvalidError field="password_confirmation" />
        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
          class="mt-1 block w-full" required autocomplete="new-password" />
      </div>
    </div>
  </Modal>

</template>