<script setup>
import { ref , nextTick } from 'vue';

import { useGoal } from '../../composables/useGoal';

const { createGoal, loader } = useGoal()

const isFormVisible = ref(false)

const props = defineProps({
  category: {
    type: Object,
    required: true,
  }
});

const emits = defineEmits(['stored'])

// const categoryData = inject('category', props.category)




const categoryForm = ref({
  name: '',
})



const inputGoalName = ref(null)

const showForm = async () => {
  isFormVisible.value = !isFormVisible.value;

  if (isFormVisible.value && inputGoalName.value) {
    nextTick(() => {

        categoryForm.value.name = ''
        inputGoalName.value.focus()
    })
    
    // await nextTick()
    // inputGoalName.value.focus();
  }

}

const hidedForm = (params) => {
  isFormVisible.value = false
}

const handleCreateGoal = async () => {
  const { success, data }  = await createGoal({
    name: categoryForm.value.name,
    category_id: props.category.id,
  })

  if (success) {
    console.log({ id: data.id });
    
    emits('stored', { id: data.id })
    hidedForm()
    clearCategoryForm()
  }
}


const clearCategoryForm = async (params) => {
    categoryForm.value = {
        name: '',
    }
}
</script>

<template>



    <Loader v-if="loader" />
    <div>
        <div class="flex justify-between items-center">
            <div>
                <span class="font-bold">
                    Metas
                    (<slot></slot>)
                </span>
            </div>
            <button class="px-2 py-1 text-sm  bg-gray-200 rounded-md hover:scale-110 hover:bg-gray-300 transition-all duration-200 ease-in-out"
                @click="showForm"
            >
                <template v-if="isFormVisible"> 
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                </template>
                <template v-else>
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                </template>

            </button>
        </div>
    
        <div class=" mt-1 mb-3" v-show="isFormVisible">
            <form action="" @submit.prevent="handleCreateGoal">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg width="20px" height="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#e8e8e8"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> </defs> <title></title> <g data-name="Winner" id="Winner-2"> <path class="cls-1" d="M14.871,26.048C4.827,26.048.765,15.87.018,10.264A2,2,0,0,1,2,8H12a2,2,0,0,1,0,4H4.469c1.014,3.722,3.906,10.633,11.365,10.007a2,2,0,0,1,.332,3.986Q15.5,26.049,14.871,26.048Z"></path> <rect class="cls-2" height="4" rx="2" ry="2" width="34" x="7" y="2"></rect> <rect class="cls-3" height="4" rx="2" ry="2" width="34" x="7" y="2"></rect> <path class="cls-4" d="M33.129,26.048q-.633,0-1.295-.055a2,2,0,1,1,.332-3.986c7.5.622,10.37-6.284,11.373-10.007H36a2,2,0,0,1,0-4H46a2,2,0,0,1,1.982,2.264C47.235,15.87,43.172,26.047,33.129,26.048Z"></path> <path class="cls-1" d="M33.129,26.048q-.633,0-1.295-.055a2,2,0,1,1,.332-3.986c7.5.622,10.37-6.284,11.373-10.007H36a2,2,0,0,1,0-4H46a2,2,0,0,1,1.982,2.264C47.235,15.87,43.172,26.047,33.129,26.048Z"></path> <polygon class="cls-1" points="28 35 20 35 21 30 27 30 28 35"></polygon> <path class="cls-5" d="M34,45H14V36a1.027,1.027,0,0,1,1.053-1H32.947A1.027,1.027,0,0,1,34,36Z"></path> <rect class="cls-6" height="5" width="12" x="18" y="38"></rect> <path class="cls-4" d="M10,6H38a0,0,0,0,1,0,0V17A14,14,0,0,1,24,31h0A14,14,0,0,1,10,17V6a0,0,0,0,1,0,0Z"></path> <rect class="cls-7" height="3" rx="1" ry="1" width="28" x="10" y="45"></rect> </g> </g></svg>
                    </div>
                    <input 
                        v-model="categoryForm.name"
                        ref="inputGoalName"

                        type="Goal" id="Goal" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Ingresa la meta que deseas alcanzar..." required 
                        />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
                </div>
            </form>

        </div>
    </div>

</template>

<style >
</style>