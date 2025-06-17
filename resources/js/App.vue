<script setup>
import { Toaster, toast } from 'vue-sonner'
import 'vue-sonner/style.css'

import { ref } from 'vue';

import CustomModal from './commons/CustomModal.vue';
import Category from './components/Category/Category.vue';
import Tasks from './components/Tasks/Tasks.vue';

import StoreCategory from './components/Category/StoreCategory.vue';

import  { useCategory } from './composables/useCategory.js'

const { getCategories, categories, loader } = useCategory()
getCategories()

const showCategoryModal = ref(false)
const showTasksModal = ref(false)


const openModalCategory = async () => {
    showCategoryModal.value = true
}

const openModalTasks = async () => {
    showTasksModal.value = true
}

</script>

<template>

    <Loader v-if="loader" />
    
    <Toaster 
        richColors  
    />

    <CustomModal
        :show="showTasksModal"
        :closeable="true"
        maxWidth="lg"
        @close="showTasksModal = false"
    >
        <Tasks  />
        <div class="px-4 py-2 flex justify-end gap-2">
            <button type="button" 
                @click="showTasksModal = false"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
        </div>
    </CustomModal>


    <StoreCategory
        
        v-model="showCategoryModal"
        @stored="getCategories"
    />

    <div>
        <h1 class="text-4xl font-bold text-center text-gray-300">VISUALIZADOR DE METAS </h1>

        <div class="text-end mt-2">
            <button class="px-3 py-1 bg-green-600 rounded-md"
                @click="openModalCategory"
            >
                <div class="text-black font-bold flex items-center gap-2 ">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 4.5L4.5 3.75H10.5L11.25 4.5V10.5L10.5 11.25H4.5L3.75 10.5V4.5ZM5.25 5.25V9.75H9.75V5.25H5.25ZM13.5 3.75L12.75 4.5V10.5L13.5 11.25H19.5L20.25 10.5V4.5L19.5 3.75H13.5ZM14.25 9.75V5.25H18.75V9.75H14.25ZM17.25 20.25H15.75V17.25H12.75V15.75H15.75V12.75H17.25V15.75H20.25V17.25H17.25V20.25ZM4.5 12.75L3.75 13.5V19.5L4.5 20.25H10.5L11.25 19.5V13.5L10.5 12.75H4.5ZM5.25 18.75V14.25H9.75V18.75H5.25Z" fill="#000000"></path> </g></svg>
                    <span>Nueva Categoría</span>
                </div>
            </button>
        </div>

        <div v-for="(item, index) in categories" :key="item.id"
            class="mt-6"
        >
            <Category 
                :category="item"
                @goalClicked="openModalTasks"
            />
        </div>
    </div>
</template>

<style>
</style>