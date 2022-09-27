<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Alert/Modal.vue';
import { ref } from 'vue';
import InputLabel from '@/Components/Input/InputLabel.vue';
import TextInput from '@/Components/Input/TextInput.vue';
const modalShow = ref(false)

const modalClose = () => modalShow.value = false
const modalOpen = () => modalShow.value = true

const decide = () => {}
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
                        <button class="mx-2 my-2 bg-green-700 transition duration-150 ease-in-out hover:bg-green-600 rounded text-white px-8 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600" @click="modalOpen">棟情報登録</button>
                      
                        <table class="w-full whitespace-nowrap">
                            <thead>
                                <tr
                                tabindex="0"
                                    class="
                                        focus:outline-none
                                        h-16
                                        w-full
                                        text-sm
                                        leading-none
                                        text-gray-800
                                        "
                                    >
                                    <th colspan="5">製材寸法</th>
                                    <th>原木末口径(mm)</th>
                                    <th>在庫本数</th>
                                    <th>棟登録合計</th>
                                    <th>予定必要本数</th>
                                    <th>不足本数</th>
                                </tr>
                            </thead>
                            <tbody class="w-full">
                                <tr
                                tabindex="0"
                                class="
                                    focus:outline-none
                                    h-16
                                    text-gray-800
                                    bg-white
                                    hover:bg-indigo-50
                                    text-center
                                    border-b border-t border-gray-100
                                "
                                >
                                    <td class="border-l border-gray-200">3000</td>
                                    <td>×</td>
                                    <td>105</td>
                                    <td>×</td>
                                    <td class="border-r border-gray-200">105</td>
                                    <td class="border-r border-gray-200">140</td>
                                    <td class="border-r border-gray-200">20</td>
                                    <td class="border-r border-gray-200">10</td>
                                    <td class="border-r border-gray-200 bg-gray-100 font-semibold hover:bg-indigo-100">90</td>
                                    <td class="border-r border-gray-200">10</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr
                                tabindex="0"
                                    class="
                                        h-16
                                        w-full
                                        text-center
                                        text-gray-800
                                        "
                                    >
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
    <Modal button-ok="確定" :show="true" modal-title="在庫登録" @emit-close="modalClose">
        <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 pt-6 gap-8">
            <div class="h-full">
                
                <label for="producer" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">生産所</label>
                <select id="producer" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border">
                    <option value=""></option>
                    <option value="">製材所１</option>
                    <option value="">製材所２</option>
                    <option value="">製材所３</option>
                </select>
                <label for="importDate" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">入荷日</label>
                <input type="date" id="importDate" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
            </div>
            <div class="h-full">
                <label for="warehouse" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">倉庫</label>
                <select id="warehouse" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border">
                    <option value=""></option>
                    <option value="">倉庫１</option>
                    <option value="">倉庫２</option>
                    <option value="">倉庫３</option>
                </select>
                <label for="expiry" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">備考</label>
                <input id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="備考" />
            </div>
        </div>
        <div class="w-full h-full mb-10">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr
                    tabindex="0"
                        class="
                            focus:outline-none
                            h-16
                            w-full
                            text-sm
                            leading-none
                            text-gray-800
                            "
                        >
                        <th>名称</th>
                        <th colspan="5">製材寸法</th>
                        <th>数量</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    <tr
                    tabindex="0"
                    class="
                        focus:outline-none
                        h-16
                        text-gray-800
                        bg-white
                        hover:bg-indigo-50
                        text-center
                        border-b border-t border-gray-100
                    "
                    >
                        <td class="border-r border-l border-gray-200">杉製材</td>
                        <td class="border-l border-gray-200">3000</td>
                        <td>×</td>
                        <td>105</td>
                        <td>×</td>
                        <td class="border-r border-gray-200">105</td>
                        <td class="border-r border-gray-200">10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Modal>
    </div>
</template>
