<script setup>

import { inject } from 'vue'
import { useGoal } from '../../composables/useGoal';

const { deleteGoal, loader } = useGoal()

const props = defineProps({
  goal: {
    type: Object,
    required: true,
  }
});

const category = inject('category', null)

const emits = defineEmits(['deleted'])


const handleDeleteGoal = async (e) => {
  e.stopPropagation()
  // console.log('handleDeleteGoal', props.goal.id);
  
  const confirmed = confirm('¿Estás seguro de eliminar esta meta?')

  if (!confirmed)  return

  const { success } = await deleteGoal(props.goal.id)

  if (success) {
    emits('deleted')
  } 
}
``
const openTasksModal = async (e) => {
    alert('Abrir modal de tareas')
}
</script>

<template>
    <Loader v-if="loader"/>

    <div class="cursor-pointer text-lg font-bold border rounded-md px-4 py-2 mt-2 flex justify-between"
      :style="{ borderColor: category?.color }"
      @click="openTasksModal"
        >
        <div class="flex justify-between gap-2">
          <div>
            <svg width="18px" height="18px" fill="#e8e8e8" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> </defs> <title></title> <g data-name="Winner" id="Winner-2"> <path class="cls-1" d="M14.871,26.048C4.827,26.048.765,15.87.018,10.264A2,2,0,0,1,2,8H12a2,2,0,0,1,0,4H4.469c1.014,3.722,3.906,10.633,11.365,10.007a2,2,0,0,1,.332,3.986Q15.5,26.049,14.871,26.048Z"></path> <rect class="cls-2" height="4" rx="2" ry="2" width="34" x="7" y="2"></rect> <rect class="cls-3" height="4" rx="2" ry="2" width="34" x="7" y="2"></rect> <path class="cls-4" d="M33.129,26.048q-.633,0-1.295-.055a2,2,0,1,1,.332-3.986c7.5.622,10.37-6.284,11.373-10.007H36a2,2,0,0,1,0-4H46a2,2,0,0,1,1.982,2.264C47.235,15.87,43.172,26.047,33.129,26.048Z"></path> <path class="cls-1" d="M33.129,26.048q-.633,0-1.295-.055a2,2,0,1,1,.332-3.986c7.5.622,10.37-6.284,11.373-10.007H36a2,2,0,0,1,0-4H46a2,2,0,0,1,1.982,2.264C47.235,15.87,43.172,26.047,33.129,26.048Z"></path> <polygon class="cls-1" points="28 35 20 35 21 30 27 30 28 35"></polygon> <path class="cls-5" d="M34,45H14V36a1.027,1.027,0,0,1,1.053-1H32.947A1.027,1.027,0,0,1,34,36Z"></path> <rect class="cls-6" height="5" width="12" x="18" y="38"></rect> <path class="cls-4" d="M10,6H38a0,0,0,0,1,0,0V17A14,14,0,0,1,24,31h0A14,14,0,0,1,10,17V6a0,0,0,0,1,0,0Z"></path> <rect class="cls-7" height="3" rx="1" ry="1" width="28" x="10" y="45"></rect> </g> </g></svg>
          </div>

          {{ props.goal.name }}
        </div>
        <div>
            <button class="text-sm bg-red-500 py-1 px-3 rounded-md"
              @click="handleDeleteGoal"`
            >   
              <svg width="20px" height="20px"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>
        </div>
    </div>
</template>

<style >
</style>