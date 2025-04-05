<script setup>
import { ref, reactive } from 'vue';
import Category from './components/Category.vue';
import CustomModal from './commons/CustomModal.vue';

import  { useCategory } from './composables/useCategory.js'

const { getCategories, categories, createCategory } = useCategory()
getCategories()

const showCategoryModal = ref(false)

const categoryData = reactive({
    name: '',
    color: '#000000',
})

const openModalCategory = async () => {
    showCategoryModal.value = true
}


const closeCategoryModal = async (params) => {
    showCategoryModal.value = false
}


const handleCreateCategory = async (e) => {
    e.preventDefault() 

    const { success } = await createCategory(categoryData)

    if (success) {
        getCategories()
        
        closeCategoryModal()
        clearCategoryForm()
    }
}

const clearCategoryForm = async () => {
    categoryData.name = ''  
    categoryData.color = '#000000'  
}

</script>

<template>
    <CustomModal
        :show="showCategoryModal"
        @close="closeCategoryModal"
    >
        <h2 class="ps-12 pt-4">Nueva categoría</h2>
        <form class="max-w-md mx-auto my-6" 
            @submit="handleCreateCategory"
        >
            <div class="relative z-0 w-full mb-5 group">
                <input type="nombre" name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " 
                    v-model="categoryData.name"
                />
                <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Nombre
                </label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
                <input type="color" id="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10" placeholder="John" required 
                    v-model="categoryData.color"
                />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" 
                    @click="closeCategoryModal"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                <button type="submit" 
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Crear</button>
            </div>
        </form>
    </CustomModal>

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