<script setup>
import { ref , nextTick } from 'vue';

import { useGoalStore } from '../../stores/useGoalStore';
import { useTask } from '../../composables/useTask';

const { createTask, loader } = useTask()
const { goal } = useGoalStore()

const isFormVisible = ref(false)


const emits = defineEmits(['stored'])


const taskForm = ref({
  name: '',
})

const inputTaskName = ref(null)

const showForm = async () => {
  isFormVisible.value = !isFormVisible.value;

  if (isFormVisible.value && inputTaskName.value) {
    nextTick(() => {

        taskForm.value.name = ''
        inputTaskName.value.focus()
    })
    // await nextTick()
    // inputTaskName.value.focus();
  }

}

const hidedForm = (params) => {
  isFormVisible.value = false
}

const handleCreateTask = async () => {
  if (!goal.value?.id) return

  const { success }  = await createTask({
    name: taskForm.value.name,
    goal_id: goal.value.id
  })

  if (success) {
    emits('stored')
    hidedForm()
    clearTaskForm()
  }
}


const clearTaskForm = async (params) => {
    taskForm.value = {
        name: '',
    }
}
</script>

<template>

    <Loader v-if="loader" />
    <div>
        <div class="flex justify-end items-center">
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
            <form action="" @submit.prevent="handleCreateTask">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg fill="#fff" width="20px" height="20px" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M0 0h192v192H0z" style="fill:none"></path><path d="m67.033 149.837-.002-.002s-.072-.065.002.002c4.696 4.475 12.141 4.404 16.753-.208l80.702-80.702c4.68-4.683 4.68-12.287 0-16.97l-9.58-9.586c-4.689-4.683-12.293-4.683-16.976 0L75.3 105.003 54.044 83.746c-4.683-4.683-12.287-4.683-16.971 0l-9.585 9.586c-4.683 4.683-4.683 12.287 0 16.97l39.545 39.535Zm-31.06-48.02 9.586-9.585 25.499 25.499a6 6 0 0 0 8.485 0l66.874-66.875 9.581 9.586L74.3 141.144l-38.327-39.327Z"></path></g></svg>
                    </div>
                    <input 
                        v-model="taskForm.name"
                        ref="inputTaskName"

                        type="Task" id="Task" 
                        class="block w-full py-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Escribe una tarea para cumplir la meta" required 
                        />
                    <button type="submit" class=" text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
                </div>
            </form>

        </div>
    </div>

</template>

<style >
</style>