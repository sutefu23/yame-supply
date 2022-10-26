<script setup lang="ts">
import { ref, onBeforeMount } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import RegisterInStockModal from '../AppModules/Form/RegisterInStockModal.vue';
import useItems, { GetItemData } from '@/hooks/api/useItems';
const showModal = ref(false)
const modalOpen = () => {
  showModal.value = true
}
const { fetch: fetchItems } = useItems()

const items = ref<GetItemData[]>([])

onBeforeMount(async () => {
  items.value = await fetchItems()
})

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
                    <th>予定必要本数</th>
                    <th>不足本数</th>
                  </tr>
                </thead>
                <tbody class="w-full">

                  <tr v-for="item in items" :key="item.id" tabindex="0" class="
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
                    <td class="border-r border-gray-200">{{ item.quantity }}</td>
                    <td class="border-r border-gray-200">0</td>
                    <td class="border-r border-gray-200 bg-gray-100 font-semibold hover:bg-indigo-100">
                      {{ item.essential_quantity }}</td>
                    <td class="border-r border-gray-200">0</td>
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
                    <td class="border-l border-b border-r border-gray-200 font-bold bg-gray-100">200</td>
                    <td class="border-l border-b border-r border-gray-200 font-semibold">400</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <RegisterInStockModal v-if="items.length" :items="items" :show="showModal" @close="showModal = false" />
  </div>


</template>
