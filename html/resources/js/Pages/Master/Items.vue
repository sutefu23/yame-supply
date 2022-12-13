<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/inertia-vue3';
import { GetItemData } from '@/hooks/api/useItems';
import TextInput from '@/Components/Input/TextInput.vue';
const { props } = usePage<{ Items: GetItemData[] }>()
const items = props.value.Items

const form = useForm({
  items
})
const onSubmit = async () => {
  await form.patch('/master/Items', {
    onSuccess: () => {
      alert('登録しました。')
    },
    onError: (e) => {
      alert(e.message)
      console.error(e)
    }
  })
}

</script>
<template>
  <div>

    <Head title="基準在庫設定" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
          基準在庫設定
        </h2>
      </template>
      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
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
                    <th>1棟当たり基準数</th>
                  </tr>
                </thead>
                <tbody class="w-full">
                  <tr v-for="(item, index) in form.items" :key="item.id" tabindex="0" class="
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
                        <TextInput name="quantity" class="w-12" v-model="form.items[index].essential_quantity">
                        </TextInput>
                        <div class="h-full">{{ item.unit.name }}</div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="text-center">
                <button
                  class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                  @click="onSubmit">登録</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>


</template>
