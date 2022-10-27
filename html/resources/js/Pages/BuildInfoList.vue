<script setup lang="ts">
import { ref, onBeforeMount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import RegisterBuildingInfoStockModal from '../AppModules/Form/RegisterBuildInfoModal.vue';
import useItems, { GetItemData } from '@/hooks/api/useItems';
import useBuildingInfo, { GetBuilingInfoData } from '@/hooks/api/useBuildingInfo';
import dayjs from 'dayjs';
const showModal = ref(false)
const modalOpen = () => {
  showModal.value = true
}
const { fetch: fetchItems } = useItems()

const items = ref<GetItemData[]>([])

const { fetch: fetchInfos } = useBuildingInfo(items.value)

const buidingInfos = ref<GetBuilingInfoData[]>([])


onBeforeMount(async () => {
  items.value = await fetchItems()
  buidingInfos.value = await fetchInfos()
})

const onSubmitSuccess = async () => {
  alert("登録しました。")
  showModal.value = false
}
</script>
<template>
  <div>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
          棟情報一覧
        </h2>
      </template>
      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
              <button
                class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                @click="modalOpen">詳細</button>

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
                    <th>現場名</th>
                    <th>工務店</th>
                    <th>期限</th>
                    <th>登録日</th>
                  </tr>
                </thead>
                <tbody class="w-full">

                  <tr v-for="info in buidingInfos" :key="info.id" tabindex="0" class="
                          focus:outline-none
                          h-16
                          text-gray-800
                          bg-white
                          hover:bg-indigo-50
                          text-center
                          border-b border-t border-gray-100
                      ">
                    <td class="border-r border-l border-gray-200">{{ info.field_name }}</td>
                    <td class="border-r border-gray-200">{{ info.user.name }}</td>
                    <td class="border-r border-gray-200">{{ dayjs(info.time_limit).format('YYYY-MM-DD') }}</td>
                    <td class="border-r border-gray-200">{{ dayjs(info.created_at).format('YYYY-MM-DD') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterBuildingInfoStockModal v-if="items.length" :items="items" :show="showModal" @close="showModal = false"
      @on-success="onSubmitSuccess" />
  </div>


</template>
