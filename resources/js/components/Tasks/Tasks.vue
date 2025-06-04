<script setup>
import { watch, computed } from 'vue';

import FormTask from './FormTask.vue';
import TaskItem from './TaskItem.vue';

import { useGoalStore } from '../../stores/useGoalStore';
import { useTask } from '../../composables/useTask';

const { goal,  } = useGoalStore()
const { tasks, getTasks, loader, deleteTask, toggleCheckTasks} = useTask()

// getTasks({
//     goalId: goal.value?.id
// })

const requestTasks = async (params) => {
    if (!goal.value?.id) return

    getTasks({
        goalId: goal.value?.id
    })
}


watch(goal, (newValue, old)=>{
     getTasks({
        goalId: newValue.id
    })
})


const handleDeleteTask = async (taskId) => {

    const confirmed = confirm('¿Estás seguro de eliminar esta tarea?')

    if (!confirmed) return

    const { success } = await deleteTask(taskId)

    if (success) {
        requestTasks()
    }
}

const handleCheckTask = async (taskId) => {
    console.log({taskId});
    const { success } = await toggleCheckTasks(taskId)
    // const { success } = await toggleCheckTasks(taskId)

    if (success) {
        requestTasks()
    }
}

const totalTaskChecked = computed(() => {
    return tasks.value.filter(task => task.completed).length
})

</script>

<template>

    <Loader v-if="loader" />
    <div class="px-3 py-2">
        <div class="flex items-center">

       <svg width="30px" height="30px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="m 7 0 c -0.554688 0 -1 0.445312 -1 1 h -2 c -1.644531 0 -3 1.355469 -3 3 v 9 c 0 1.644531 1.355469 3 3 3 h 2 c 0.550781 0 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 h -2 c -0.570312 0 -1 -0.429688 -1 -1 v -9 c 0 -0.570312 0.429688 -1 1 -1 h 1 v 1 c 0 0.554688 0.445312 1 1 1 h 4 c 0.554688 0 1 -0.445312 1 -1 v -1 h 1 c 0.570312 0 1 0.429688 1 1 v 2 c 0 0.550781 0.449219 1 1 1 s 1 -0.449219 1 -1 v -2 c 0 -1.644531 -1.355469 -3 -3 -3 h -2 c 0 -0.554688 -0.445312 -1 -1 -1 z m 0 0" fill="#ffffff"></path> <path d="m 8.875 8 c -0.492188 0 -0.875 0.382812 -0.875 0.875 v 6.25 c 0 0.492188 0.382812 0.875 0.875 0.875 h 6.25 c 0.492188 0 0.875 -0.382812 0.875 -0.875 v -6.25 c 0 -0.492188 -0.382812 -0.875 -0.875 -0.875 z m 2.125 1 h 2 v 2.5 s 0 0.5 -0.5 0.5 h -1 c -0.5 0 -0.5 -0.5 -0.5 -0.5 z m 0.5 4 h 1 c 0.277344 0 0.5 0.222656 0.5 0.5 v 1 c 0 0.277344 -0.222656 0.5 -0.5 0.5 h -1 c -0.277344 0 -0.5 -0.222656 -0.5 -0.5 v -1 c 0 -0.277344 0.222656 -0.5 0.5 -0.5 z m 0 0" class="warning" fill="#ff7800"></path> </g></svg>
        <div>
            <h2 class="ms-2 text-lg font-semibold">
                Tareas de 
                <strong>
                    {{ goal?.name }}
                </strong>
            </h2>
        </div>
        </div>
        <div>
            <FormTask
                @stored="requestTasks"
            />
        </div>
         <div class="text-end mt-4"
                v-if="tasks.length"
            >
                <p class="font-bold text-lg">Tareas completadas {{ totalTaskChecked }}/{{ tasks.length }}</p>
            </div>
        <div class="mt-2">
           
            <template v-for="item in tasks" :key="item.id">
                <div class="mb-2">
                    <TaskItem
                        :task="item"
                        @delete="handleDeleteTask"
                        @check="handleCheckTask"
                        />
                </div>
                <!-- <div class="border rounded-md px-4 py-2 mt-2 flex justify-between items-center"
                    :class="{
                        'bg-gray-800': item.completed,
                        'bg-gray-700': !item.completed
                    }"
                >
                    <div>
                        {{ item.name }}
                    </div>
                    <div>
                        <span v-if="item.completed" class="text-green-500">Completada</span>
                        <span v-else class="text-red-500">Pendiente</span>
                    </div>
                </div> -->
                

            </template>

            <template v-if="!tasks.length">
                <div class="text-center flex justify-center items-center gap-2 mt-4">
                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V8C21 8.55228 20.5523 9 20 9C19.4477 9 19 8.55228 19 8V4C19 3.44772 18.5523 3 18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H10C10.5523 21 11 21.4477 11 22C11 22.5523 10.5523 23 10 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM6.41421 7H9V4.41421L6.41421 7ZM20.1716 18.7574C20.6951 17.967 21 17.0191 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21C17.0191 21 17.967 20.6951 18.7574 20.1716L21.2929 22.7071C21.6834 23.0976 22.3166 23.0976 22.7071 22.7071C23.0976 22.3166 23.0976 21.6834 22.7071 21.2929L20.1716 18.7574ZM13 16C13 14.3431 14.3431 13 16 13C17.6569 13 19 14.3431 19 16C19 17.6569 17.6569 19 16 19C14.3431 19 13 17.6569 13 16Z" fill="#ffffff"></path> </g></svg>
                    <div>
                        Meta sin tareas definidas</div>
                    </div>
            </template>
        </div>
    </div>
</template>