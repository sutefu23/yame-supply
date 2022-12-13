<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { GetBuilingInfoData } from '@/hooks/api/useBuildingInfo';
import { GetUserData } from '@/hooks/api/useUsers';
import RegisterUserModal from '@/AppModules/Form/RegisterUserModal.vue';
const { props } = usePage<{ Users: GetUserData[] }>()
const users = props.value.Users

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

    <Head title="ユーザーマスタ" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-l text-gray-800 leading-tight">
          ユーザーマスタ
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
                    <th>会社カテゴリ</th>
                    <th>email</th>
                  </tr>
                </thead>
                <tbody class="w-full">
                  <tr v-for="user in users" :key="user.id" tabindex="0" class="
                          focus:outline-none
                          h-16
                          bg-white
                          hover:bg-indigo-50
                          text-center
                          border-b border-t border-gray-100
                          cursor-pointer
                      " @click="(selectedId = user.id)">
                    <td class="border-r border-l border-gray-200">
                      <label
                        class="text-center w-full h-full cursor-pointer transition-all opacity-75 hover:opacity-50">
                        <input :checked="(user.id === selectedId)" type="radio">
                      </label>
                    </td>
                    <td class="border-r border-gray-200">{{ user.id }}</td>
                    <td class="border-r border-gray-200">{{ user.name }}</td>
                    <td class="border-r border-gray-200">{{ user.user_category.name }}</td>
                    <td class="border-r border-gray-200">{{ user.email }}</td>
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
    <RegisterUserModal v-if="showModal" :edit-id="selectedId" :show="showModal" @close="showModal = false"
      @on-success="onSubmitSuccess" />
  </div>


</template>
