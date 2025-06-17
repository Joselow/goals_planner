import { ref } from 'vue'

import { toast } from 'vue-sonner'

import { useGoalStore } from '../stores/useGoalStore'
import { useCategory } from './useCategory'
const { goal, setGoal, clearGoal } = useGoalStore()

const goals = ref([])



const { categories } = useCategory()

export function useGoal() {
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
                data: data.goal
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

    const getProgress = async ({ goalId = null, categoryId = null}) => {
       try {
            loader.value = true
            const { data } = await window.axios({
                method: 'GET',
                url: 'goal/progress',
                params: {
                    goalId,
                    categoryId,
                }
            })

            const progressData = data.progress

            console.log(data.progress);
            

            const goalFound = goals.value.find(goal => goal.id == progressData.goal.id)

            if (goalFound) {
                goalFound.percentage = progressData.goal.percentage
            }

            const categoryFound = categories.value.find(category => category.id == progressData.category.id)

    
            if (categoryFound) {
                categoryFound.percentage = progressData.category.percentage
            }


            return {
                success: true,
                data: data.progress
            }
        } catch (error) {
            toast.error(error.response?.data?.message)

            return {
                success: false,
                data: null
            }
        } finally { loader.value = false }
    }

    return {
        getGoals,
        goals,
        createGoal,
        deleteGoal,
        loader,
        goal,
        setGoal,
        clearGoal,
        getProgress
    }
}