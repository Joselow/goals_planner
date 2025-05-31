<script setup>
import { Toaster, toast } from 'vue-sonner'
import 'vue-sonner/style.css'

import { ref } from 'vue';

import Category from './components/Category/Category.vue';

import StoreCategory from './components/Category/StoreCategory.vue';

import  { useCategory } from './composables/useCategory.js'

const { getCategories, categories } = useCategory()
getCategories()

const showCategoryModal = ref(false)


const openModalCategory = async () => {
    showCategoryModal.value = true
}

</script>

<template>
    
    <Toaster 
        richColors  
    />
    <StoreCategory
        
        v-model="showCategoryModal"
        @stored="getCategories"
    />

    <div>
        <h1 class="text-gray-300">Aqui ESTA MI APP DE VUE</h1>

        <div class="text-end"
            @click="openModalCategory"
        >
            <button class="px-3 py-1 bg-green-600 rounded-md">Crear</button>
        </div>

        <div v-for="(item, index) in categories" :key="index"
            class="mt-6"
        >
            <Category 
                :category="item"
            />
        </div>
    </div>
</template>

<style>
</style>