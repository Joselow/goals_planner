<script setup>
import Category from './components/Category.vue';

import  { useCategory } from './composables/useCategory.js'

const { getCategories, categories } = useCategory()
getCategories()


const handleCreateCategory = async () => {
    try {
        const { data } = await window.axios({
            method: 'POST',
            url: 'categories/create',
            data: {
                name: 'Nueva Categoria',
                color: '#000000',
            }
        })
        console.log(data);
        
    } catch (error) {
        console.log(error);
    }
  
}
</script>

<template>
    <div>
        <h1 class="text-gray-300">Aqui ESTA MI APP DE VUE</h1>

        <div class="text-end"
            @click="handleCreateCategory"
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