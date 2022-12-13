<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { GetBuilingInfoData } from '@/hooks/api/useBuildingInfo';
import { WarehouseType } from '@/hooks/api/useMaster';
import RegisterMasterModal from '@/AppModules/Form/RegisterMasterModal.vue';
const { props } = usePage<{ Warehouses: WarehouseType[] }>()
const warehouses = props.value.Warehouses

const selectedId = ref<GetBuilingInfoData["id"]>(0)

const showModal = ref(false)

const editModalOpen = () => {
  if (!selectedId.value) {
    alert("明細を選択してください。")
    return
  }
  showModal.value = true
}
const registerModalOpen = () => {
  selectedId.value = 0
  showModal.value = true
}


const onSubmitSuccess = async () => {
  alert("登録しました。")
  showModal.value = false
  window.location.reload()
}
</script>
<template>
  <div>

    <Head title="倉庫マスタ" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
          倉庫マスタ
        </h2>
      </template>
      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
              <table class="w-full whitespace-nowrap">
                <thead>
                  <tr tabindex="0" class="
                      focus:outline-none
                      h-16
                      w-full
                      text-sm
                      leading-none
                      text-gray-800
                      ">
                    <th></th>
                    <th>ID</th>
                    <th>名称</th>
                  </tr>
                </thead>
                <tbody class="w-full">
                  <tr v-for="warehouse in warehouses" :key="warehouse.id" tabindex="0" class="
                          focus:outline-none
                          h-16
                          bg-white
                          hover:bg-indigo-50
                          text-center
                          border-b border-t border-gray-100
                          cursor-pointer
                      " @click="(selectedId = warehouse.id)">
                    <td class="border-r border-l border-gray-200">
                      <label
                        class="text-center w-full h-full cursor-pointer transition-all opacity-75 hover:opacity-50">
                        <input :checked="(warehouse.id === selectedId)" type="radio">
                      </label>
                    </td>
                    <td class="border-r border-gray-200">{{ warehouse.id }}</td>
                    <td class="border-r border-gray-200">{{ warehouse.name }}</td>
                  </tr>
                </tbody>
              </table>
              <button
                class="mx-2 my-2 bg-blue-700 transition duration-150 ease-in-out hover:bg-blue-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600"
                @click="registerModalOpen">新規登録</button>
              <button
                class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                @click="editModalOpen">編集</button>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterMasterModal v-if="showModal" master="Warehouse" :edit-id="selectedId" :show="showModal"
      @close="showModal = false" @on-success="onSubmitSuccess" />
  </div>


</template>
