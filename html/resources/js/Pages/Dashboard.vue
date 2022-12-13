<script setup lang="ts">
import { ref, onBeforeMount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import RegisterBuildingInfoStockModal from '../AppModules/Form/RegisterBuildInfoModal.vue';
import useItems, { GetItemData } from '@/hooks/api/useItems';
import TextInput from '@/Components/Input/TextInput.vue';
import { computed } from 'vue';
const showModal = ref(false)
const modalOpen = () => {
  showModal.value = true
}
const { fetch: fetchItems } = useItems()

const essentialBuildNum = ref(10)
const items = ref<GetItemData[]>([])

onBeforeMount(async () => {
  items.value = await fetchItems()
})

const onSubmitSuccess = async () => {
  alert("登録しました。")
  showModal.value = false
  window.location.reload()
}

const computeItems = computed(() => (items.value.map((item) => ({
  ...item,
  required_count: 0 + item.essential_quantity * essentialBuildNum.value,
  shortage_count: item.quantity - (0 + item.essential_quantity * essentialBuildNum.value)
}))))

const buildQuantitySum = computed(() => (items.value.reduce<number>((bldQtySum, item) => Number(bldQtySum) + Number(item.build_quantity), 0)))
const essentialQuantitySum = computed(() => (items.value.reduce<number>((estQtySum, item) => Number(estQtySum) + (Number(item.essential_quantity) * Number(essentialBuildNum.value)), 0)))

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
                    <th>名称</th>
                    <th colspan="5">製材寸法</th>
                    <th>原木末口径(mm)</th>
                    <th>在庫本数</th>
                    <th>棟登録合計</th>
                    <th>1棟当基準数
                      <div class="flex items-center justify-center">
                        <TextInput name="quantity" type="number" class="w-16" v-model="essentialBuildNum">
                        </TextInput>
                        <div class="h-full">棟分</div>
                      </div>
                    </th>
                    <th>予定必要本数</th>
                    <th>不足本数</th>
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
                    <td class="border-r border-l border-gray-200">{{ item.wood_species.name }}</td>
                    <td class="border-l border-gray-200">{{ item.length }}</td>
                    <td>×</td>
                    <td>{{ item.width }}</td>
                    <td>×</td>
                    <td class="border-r border-gray-200">{{ item.thickness }}</td>
                    <td class="border-r border-gray-200">{{ item.raw_wood_size }}</td>
                    <td class="border-r border-gray-200 font-bold">{{ item.quantity }}</td>
                    <td class="border-r border-gray-200">{{ item.build_quantity }}</td>
                    <td class="border-r border-gray-200">{{ item.essential_quantity * Number(essentialBuildNum) }}
                    </td>
                    <td class="border-r border-gray-200 bg-gray-100 font-semibold hover:bg-indigo-100">
                      {{ item.required_count }}</td>
                    <td class="border-r border-gray-200 font-bold"
                      :class="item.shortage_count < 0 ? 'text-red-500' : ''">
                      {{ item.shortage_count }}
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr tabindex="0" class="
                                        h-16
                                        w-full
                                        text-center
                                        text-gray-800
                                        ">
                    <td colspan="8"></td>
                    <td class="border-l border-b border-r border-gray-200 font-bold bg-gray-100">{{ buildQuantitySum
                    }}
                    </td>
                    <td class="border-l border-b border-r border-gray-200 font-semibold">{{ essentialQuantitySum }}
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterBuildingInfoStockModal :show="showModal" @close="showModal = false" @on-success="onSubmitSuccess" />
  </div>


</template>
