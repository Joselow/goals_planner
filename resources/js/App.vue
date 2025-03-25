<script setup>
import Category from './components/Category.vue';

import  { useCategory } from './composables/useCategory.js'

const { getCategories, categories } = useCategory()
getCategories()

</script>

<template>
    <h1 class="text-gray-300">Aqui ESTA MI APP DE VUE</h1>

    <div v-for="(item, index) in categories" :key="index"
        class="mt-6"
    >
        <Category 
            :category="item"
        />
    </div>
</template>

<style>

</style>