<template>
  <div class="min-w-max">
    <section
      class="flex justify-between bg-white rounded-lg border border-gray-200 px-10 py-3 text-gray-700 font-montserrat">
      <ul class="flex items-center">
        <li class="pr-6" v-if="hasPrev()">
          <a href="#" @click.prevent="changePage(prevPage)">
            <div class="flex items-center justify-center hover:bg-gray-200 rounded-md h-6 w-6">
              <div>
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
              </div>
            </div>
          </a>
        </li>
        <li class="pr-6" v-if="hasFirst()">
          <a href="#" @click.prevent="changePage(1)">
            <div class="flex hover:bg-gray-200 rounded-md h-6 w-6 items-center justify-center">
              <span>
                1
              </span>
            </div>
          </a>
        </li>
        <li class="pr-6" v-if="hasFirst()">...</li>
        <li class="pr-6" v-for="page in pages" :key="page">
          <a href="#" @click.prevent="changePage(page)">
            <div :class="{ 'bg-blue-50': current == page }"
              class="flex hover:bg-gray-200 rounded-md h-6 w-6 items-center justify-center">
              <span>{{ page }}</span>
            </div>
          </a>
        </li>
        <li class="pr-6" v-if="hasLast()">...</li>
        <li class="pr-6" v-if="hasLast()">
          <a href="#" @click.prevent="changePage(totalPages)">
            <div class="flex hover:bg-gray-200 rounded-md h-6 w-6 items-center justify-center">
              <span>
                {{ totalPages }}
              </span>
            </div>
          </a>
        </li>
        <li class="pr-6" v-if="hasNext()">
          <a href="#" @click.prevent="changePage(nextPage)">
            <div class="flex items-center justify-center hover:bg-gray-200 rounded-md h-6 w-6">
              <div>
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </div>
            </div>
          </a>
        </li>
      </ul>

      <div v-if="totalPages > 2" class="flex items-center">
        <div class="pr-2 text-gray-400">
          <span id="text-before-input">
            {{ textBeforeInput }}
          </span>
        </div>
        <div class="w-14 px-1 py-1">
          <input v-model.number="input" class="w-12 rounded-md focus:outline-none px-2" type="text">
        </div>
        <div @click.prevent="changePage(input)" class="flex items-center pl-4 cursor-pointer">
          <span id="text-after-input">
            {{ textAfterInput }}
          </span>
          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
export default defineComponent({
  name: 'Vue Tailwind Pagination',
  props: {
    current: {
      type: Number,
      default: 1
    },
    total: {
      type: Number,
      default: 0
    },
    perPage: {
      type: Number,
      default: 9
    },
    pageRange: {
      type: Number,
      default: 2
    },
    textBeforeInput: {
      type: String,
      default: 'ページ移動'
    },
    textAfterInput: {
      type: String,
      default: 'Go'
    }
  },
  data() {
    return {
      input: '',
    }
  },
  methods: {
    hasFirst: function () {
      return this.rangeStart !== 1
    },
    hasLast: function () {
      return this.rangeEnd < this.totalPages
    },
    hasPrev: function () {
      return this.current > 1
    },
    hasNext: function () {
      return this.current < this.totalPages
    },
    changePage: function (page: number | string) {
      if (page > 0 && page <= this.totalPages) {
        this.$emit('page-changed', page)
      }
    }
  },
  computed: {
    pages: function () {
      const pages = []
      for (let i = this.rangeStart; i <= this.rangeEnd; i++) {
        pages.push(i)
      }
      return pages
    },
    rangeStart: function () {
      const start = this.current - this.pageRange
      return (start > 0) ? start : 1
    },
    rangeEnd: function () {
      const end = this.current + this.pageRange
      return (end < this.totalPages) ? end : this.totalPages
    },
    totalPages: function () {
      return Math.ceil(this.total / this.perPage)
    },
    nextPage: function () {
      return this.current + 1
    },
    prevPage: function () {
      return this.current - 1
    }
  }
})
</script>