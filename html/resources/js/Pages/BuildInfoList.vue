<script setup lang="ts">
import { ref, onBeforeMount, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import RegisterBuildingInfoStockModal from '../AppModules/Form/RegisterBuildInfoModal.vue';
import useBuildingInfo, { GetBuilingInfoData } from '@/hooks/api/useBuildingInfo';
import dayjs from 'dayjs';
import Pagenation from '@/Components/Navi/Pagenation.vue';
const { fetch: fetchInfos } = useBuildingInfo()

const page = usePage<{ BulidInfoList: Pagenate<GetBuilingInfoData[]> }>()
const { data, to: last_page, total, current_page, per_page } = page.props.value.BulidInfoList
const buidingInfos = ref(data)
const selectedId = ref<GetBuilingInfoData["id"]>(0)

const showModal = ref(false)
const modalOpen = () => {
  if (!selectedId.value) {
    alert("明細を選択してください。")
    return
  }
  showModal.value = true
}

const pushRouter = (page: number) => window.location.href = route('BuildInfoList', page)

const isDisable = computed(() => buidingInfos.value.find((info) => info.id === selectedId.value)?.is_exported)

onBeforeMount(async () => {
  buidingInfos.value = await fetchInfos()
})

const onSubmitSuccess = async () => {
  alert("登録しました。")
  buidingInfos.value = await fetchInfos()
  showModal.value = false
  window.location.reload()
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
                    <th></th>
                    <th>現場名</th>
                    <th>工務店</th>
                    <th>出荷予定日</th>
                    <th>登録日</th>
                  </tr>
                </thead>
                <tbody class="w-full">
                  <tr v-for="info in buidingInfos" :key="info.id" tabindex="0" class="
                          focus:outline-none
                          h-16
                          bg-white
                          hover:bg-indigo-50
                          text-center
                          border-b border-t border-gray-100
                          cursor-pointer
                      " :class="info.is_exported ? 'text-gray-400' : 'text-gray-800'" @click="(selectedId = info.id)">
                    <td class="border-r border-l border-gray-200">
                      <label
                        class="text-center w-full h-full cursor-pointer transition-all opacity-75 hover:opacity-50">
                        <input :class="info.is_exported ? 'opacity-40' : ''" type="radio" name="infoId"
                          :checked="(info.id === selectedId)">
                      </label>
                    </td>
                    <td class="border-r border-gray-200">{{ info.field_name }}</td>
                    <td class="border-r border-gray-200">{{ info.user.name }}</td>
                    <td class="border-r border-gray-200">{{ dayjs(info.export_expected_date).format('YYYY-MM-DD') }}
                    </td>
                    <td class="border-r border-gray-200">{{ dayjs(info.created_at).format('YYYY-MM-DD') }}</td>
                  </tr>
                </tbody>
              </table>
              <nav class="py-6 text-center">
                <Pagenation :current="current_page" :page-range="10" :total="total" @page-changed="pushRouter" />
              </nav>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterBuildingInfoStockModal v-if="showModal" :edit-id="selectedId" :show="showModal" @close="showModal = false"
      :disable="isDisable" @on-success="onSubmitSuccess" />
  </div>


</template>
