import { ref } from 'vue'

import { toast } from 'vue-sonner'

export function useGoal() {
    const goals = ref([])
    const loader = ref(false)

    const getGoals = async ({ categoryId }) => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'GET',
                url: '/goals',
                params: {
                    category_id: categoryId
                }
            })
            
            if (data && Array.isArray(data)) {
                goals.value = data
            }
            
            console.log(data);
        } catch (error) {
            toast.error(error.response?.data?.message)

            console.error(error);   
        } finally { loader.value = false }
    }

    const createGoal = async ({ name, category_id}) => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'POST',
                url: 'goal',
                data: { name, category_id }
            })
            toast.success('¡Genial! Tu meta ha sido creada con éxito 🎯')

            console.log(data);
            // closeGoalModal()

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

    const deleteGoal = async (categoryId) => {
       try {
            loader.value = true
            await window.axios({
                method: 'DELETE',
                url: 'goal/' + categoryId,
            })

            toast.success('Tu meta ha sido eliminada con éxito 🎯')
            // closeGoalModal()

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
        getGoals,
        goals,
        createGoal,
        deleteGoal,
        loader
    }
}