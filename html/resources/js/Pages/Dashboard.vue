<script setup lang="ts">
import { ref, onBeforeMount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import RegisterBuildingInfoStockModal from '../AppModules/Form/RegisterBuildInfoModal.vue';
import useItems, { GetItemData, ItemData } from '@/hooks/api/useItems';
import useBuildingInfoData from '@/hooks/api/useBuildingInfo';
import TextInput from '@/Components/Input/TextInput.vue';
import useMe from '@/hooks/useMe';
import { computed } from 'vue';
const showModal = ref(false)
const modalOpen = () => {
  showModal.value = true
}
const { fetch: fetchItems, update: updateItems } = useItems()
const { fetch: fetchBuildinfo } = useBuildingInfoData()
const items = ref<GetItemData[]>([])

const buildInfoCount = ref(0)
const { isManufacturer } = useMe()

onBeforeMount(async () => {
  items.value = await fetchItems()
  const buildInfos = await fetchBuildinfo({ is_exported: false })
  buildInfoCount.value = buildInfos.length ?? 0
})

const onSubmitSuccess = async () => {
  alert("登録しました。")
  showModal.value = false
  window.location.reload()
}

const handleUpdateItem = async (item: ItemData, id: number) => {
  await updateItems(item, id)
}
const computeItems = computed(() => (items.value.map((item) => ({
  ...item,
  shortage_count_for_producer: Number(item.quantity ?? 0) - Number(item.current_month_quantity ?? 0) - Number(item.next_month_quantity ?? 0),
}))))

</script>
<template>
  <div>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
          在庫TOP
        </h2>
      </template>
      <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
              <button
                class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                @click="modalOpen">棟情報登録</button>
              <div v-if="isManufacturer()" class="text-right">
                <p class="text-sm">※直接編集したデータはカーソルを外したタイミングで保存されます。</p>
              </div>
              <table class="w-full whitespace-nowrap">
                <thead class="sticky top-0
                      z-1
                      bg-white
                      tracking-wider">
                  <tr tabindex="0" class="
                      focus:outline-none
                      h-16
                      w-full
                      text-sm
                      leading-none
                      text-gray-800
                      ">
                    <th>樹種</th>
                    <th colspan="5">製材寸法</th>
                    <!-- <th>原木末口径(mm)</th> -->
                    <th>在庫本数<br />①</th>
                    <th>当月棟分<br />②</th>
                    <th>来月棟分<br />③</th>
                    <th>
                      不足本数<br />
                      ①-(②+③)
                    </th>
                    <th>不良品</th>
                    <th>乾燥中<br>製材中</th>
                    <th>原木入荷</th>
                    <th>原木手配</th>
                  </tr>
                </thead>
                <tbody class="w-full">
                  <tr v-for="item in computeItems" :key="item.id" tabindex="0" class="
                          focus:outline-none
                          h-16
                          text-gray-800
                          bg-white
                          hover:bg-indigo-50
                          text-center
                          border-b border-t border-gray-100
                      ">
                    <td class="border-r border-l border-gray-200 px-3">{{ item.wood_species.name }}</td>
                    <td class="border-l border-gray-200 pl-2">{{ item.length }}</td>
                    <td>×</td>
                    <td>{{ item.width }}</td>
                    <td>×</td>
                    <td class="border-r border-gray-200 pr-2">{{ item.thickness }}</td>
                    <!-- <td class="border-r border-gray-200">{{ item.raw_wood_size }}</td> -->
                    <td class="border-r border-gray-200 bg-gray-100 font-bold">{{ item.quantity }}</td>
                    <td class="border-r border-gray-200 font-bold">{{ item.current_month_quantity }}</td>
                    <td class="border-r border-gray-200 font-bold">{{ item.next_month_quantity }}</td>
                    <td class="border-r border-gray-200 font-bold"
                      :class="item.shortage_count_for_producer < 0 ? 'text-red-500' : ''">{{
                        item.shortage_count_for_producer
                      }}</td>
                    <td class="border-r border-gray-200" v-if="isManufacturer()">
                      <TextInput name="defective_quantity" type="number" class="w-16 mb-0 text-right inline-block p-1"
                        v-model="item.defective_quantity" @blur="handleUpdateItem(item, item.id)"></TextInput>
                    </td>
                    <td class="border-r border-gray-200" v-else>
                      {{ item.defective_quantity }}
                    </td>
                    <td class="border-r border-gray-200" v-if="isManufacturer()">
                      <TextInput name="manufacturing_quantity" type="number" class="w-16 mb-0 text-right inline-block p-1"
                        v-model="item.manufacturing_quantity" @blur="handleUpdateItem(item, item.id)"></TextInput>
                    </td>
                    <td class="border-r border-gray-200" v-else>
                      {{ item.manufacturing_quantity }}
                    </td>
                    <td class="border-r border-gray-200" v-if="isManufacturer()">
                      <TextInput name="raw_wood_arrival_quantity" type="number"
                        class="w-16 mb-0 text-right inline-block p-1" v-model="item.raw_wood_arrival_quantity"
                        @blur="handleUpdateItem(item, item.id)">
                      </TextInput>
                    </td>
                    <td class="border-r border-gray-200" v-else>
                      {{ item.raw_wood_arrival_quantity }}
                    </td>
                    <td class="border-r border-gray-200" v-if="isManufacturer()">
                      <TextInput name="raw_wood_arrangement_quantity" type="number"
                        class="w-16 mb-0 text-right inline-block p-1" v-model="item.raw_wood_arrangement_quantity"
                        @blur="handleUpdateItem(item, item.id)">
                      </TextInput>
                    </td>
                    <td class="border-r border-gray-200" v-else>
                      {{ item.raw_wood_arrangement_quantity }}
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterBuildingInfoStockModal :show="showModal" @close="showModal = false" @on-success="onSubmitSuccess" />
  </div>
</template>
