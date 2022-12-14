<script setup lang="ts">
import { ref, onBeforeMount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import RegisterBuildingInfoStockModal from '../AppModules/Form/RegisterBuildInfoModal.vue';
import useItems, { GetItemData } from '@/hooks/api/useItems';
import useBuildingInfoData from '@/hooks/api/useBuildingInfo';
import TextInput from '@/Components/Input/TextInput.vue';
import { computed } from 'vue';
const showModal = ref(false)
const modalOpen = () => {
  showModal.value = true
}
const { fetch: fetchItems } = useItems()
const { fetch: fetchBuildinfo } = useBuildingInfoData()

const essentialBuildNum = ref(10)//必要最低棟数
const items = ref<GetItemData[]>([])

const buildInfoCount = ref(0)

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

const computeItems = computed(() => (items.value.map((item) => ({
  ...item,
  required_count: 0 + item.essential_quantity * essentialBuildNum.value,
  shortage_count_for_producer: Number(item.quantity ?? 0) - Number(item.build_quantity ?? 0),
  shortage_count_for_builder: item.quantity - (0 + item.essential_quantity * essentialBuildNum.value)
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
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 bg-white border-b border-gray-200">
              <button
                class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
                @click="modalOpen">棟情報登録</button>
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
                    <th>樹種</th>
                    <th colspan="5">製材寸法</th>
                    <!-- <th>原木末口径(mm)</th> -->
                    <th>在庫本数<br />①</th>
                    <th>必要見込本数<br />
                      <a class="underline text-blue-500" :href="route('BuildInfoList')">{{ buildInfoCount }}棟分</a>②
                    </th>
                    <th>
                      不足本数<br />
                      ①-②
                    </th>
                    <th>
                      <div class="flex items-center justify-center flex-col">
                        <div>
                          <TextInput name="quantity" type="number" class="w-16 mb-0" v-model="essentialBuildNum">
                          </TextInput>棟分
                        </div>
                        <div>必要本数③</div>
                      </div>
                    </th>
                    <th>不足本数<br />
                      ①-③
                    </th>
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
                    <td class="border-r border-gray-200">{{ item.build_quantity ?? 0 }}</td>
                    <td class="border-r border-gray-200 font-bold"
                      :class="item.shortage_count_for_producer < 0 ? 'text-red-500' : ''">{{
    item.shortage_count_for_producer
}}</td>
                    <td class="border-r border-gray-200">{{ item.essential_quantity * Number(essentialBuildNum) }}
                    </td>
                    <td class="border-r border-gray-200 font-bold"
                      :class="item.shortage_count_for_builder < 0 ? 'text-red-500' : ''">
                      {{ item.shortage_count_for_builder }}
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
