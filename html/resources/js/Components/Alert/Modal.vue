<script setup lang="ts">
import { defineProps, defineEmits } from "vue";


defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  modalTitle: {
    type: String,
    default: "タイトル"
  },
  buttonOk: {
    type: String,
    default: "OK",
  },
  buttonCancel: {
    type: String,
    default: "キャンセル",
  },
  disable: {
    type: Boolean,
    default: false
  }
});

type EmitType = {
  (e: "emit:close"): void,
  (e: "emit:ok"): void
}

const emit = defineEmits<EmitType>();

</script>
<template>
  <div v-if="show"
    class="py-12 bg-gray-700 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0"
    id="modal">
    <div role="alert" class="container mx-auto">
      <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
        <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">{{ modalTitle }}</h1>
        <slot />
        <div v-if="!disable" class="flex items-center justify-center w-full">
          <button
            class="focus:outline-none transition duration-150 ease-in-out hover:bg-green-600 bg-green-700 rounded text-white px-8 py-2 text-sm"
            @click="emit('emit:ok')">{{ buttonOk }}</button>
          <button
            class="focus:outline-none ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
            @click="emit('emit:close')">{{ buttonCancel }}</button>
        </div>
        <div
          class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out"
          @click="emit('emit:close')">
          <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20"
            height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>
