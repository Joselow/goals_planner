import { ref } from "vue"

const goal = ref(null)

const setGoal = (newGoal) => {
    goal.value = newGoal 
}

const clearGoal = () => {
    goal.value = null 
}

export function useGoalStore() {
    return {
        goal,
        setGoal,
        clearGoal
    }
}