import { ref } from 'vue'

import { toast } from 'vue-sonner'

export function useTask() {
    const tasks = ref([])
    const loader = ref(false)

    const getTasks = async ({ goalId }) => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'GET',
                url: '/tasks',
                params: {
                    goalId: goalId
                }
            })

            if (data && Array.isArray(data)) {
                tasks.value = data
            }
            
            console.log(data);
        } catch (error) {
            toast.error(error.response?.data?.message)

            console.error(error);   
        } finally { loader.value = false }
    }

    const createTask = async ({ name, goal_id}) => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'POST',
                url: 'task',
                data: { name, goal_id }
            })
            toast.success('¡Genial! Tu meta ha sido creada con éxito 🎯')

            console.log(data);
            // closeTaskModal()

            return {
                success: true,
                data
            }
        } catch (error) {
            toast.error(error.response?.data?.message)

            return {
                success: false,
                data: null
            }
        } finally { loader.value = false }
    }

    const deleteTask = async (taskId) => {
       try {
            loader.value = true
            await window.axios({
                method: 'DELETE',
                url: 'task/' + taskId,
            })

            toast.success('Tu meta ha sido eliminada con éxito 🎯')
            // closeTaskModal()

            return {
                success: true,
            }
        } catch (error) {
            toast.error(error.response?.data?.message)

            return {
                success: false,
            }
        } finally { loader.value = false }
    }

    const toggleCheckTasks = async (taskId) => {
       try {
            loader.value = true
            await window.axios({
                method: 'PATCH',
                url: 'task/'+taskId,
            })

            toast.success('Tu meta ha sido actualizada con éxito 🎯')
            // closeTaskModal()
            return {
                success: true,
            }
        } catch (error) {
            toast.error(error.response?.data?.message)

            return {
                success: false,
            }
        } finally { loader.value = false }
    }

    return {
        getTasks,
        tasks,
        createTask,
        deleteTask,
        toggleCheckTasks,
        loader
    }
}