<script setup>
import { ref, computed, provide,  } from 'vue';

import FormGoal from '../Goal/FormGoal.vue';
import Goal from '../Goal/Goal.vue';
import ProgressBar from '../../commons/ProgressBar.vue';

import { useGoal } from '../../composables/useGoal';

const { goals, getGoals, loader, getProgress } = useGoal()

const emits = defineEmits(['goalClicked'])

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
})

provide('category', props.category)

let isVisibleCard = ref(false);

let goalsRequested = false

const handleClick = async () => {
    isVisibleCard.value = !isVisibleCard.value

    if (!goalsRequested)  {
        requestGoals()
    }

    goalsRequested = true
    console.log(isVisibleCard.value);
    // console.log(isVisibleCard.value);
}

const borderColor = computed(() => {
    return `2px solid ${props.category?.color}`
}) 

const requestGoals = async () => {
    await getGoals({ categoryId: props.category.id })
}

const handleStoredGoal = async ({ id }) => {
    await requestGoals()
    getProgress({ goalId: id })
}

const goalClickedFunction = async () => {
  emits('goalClicked')
}

const handleDeletedGoal = async () => {
    requestGoals()
    getProgress({ categoryId: props.category.id })
}

</script>

<template>

    <Loader v-if="loader" />

    <ProgressBar
        :progress="category.percentage"
        :color="category.color"
        :data="{ name: category.name }"
    />
    <div class="w-full rounded-md border px-6 py-2 cursor-pointer"
        :style="{ border: borderColor  }"

        @click="handleClick"
    >
        <h1>
            {{ props.category?.name  }}
        </h1>
    </div>
    <div class="rounded-md mt-1 border px-5 py-2" 
        :style="{ border: borderColor }"
        v-show="isVisibleCard"
    >   

        <FormGoal
            :category="props.category"
            @stored="handleStoredGoal"
        >
            {{ goals.length }}
        </FormGoal>

      
        <template
             v-for="(goal, index) in goals"
            :key="goals.id"
        >
            <Goal
                :goal="goal"
                @deleted="handleDeletedGoal"
                @goalClicked="goalClickedFunction"
            />
        </template>
    </div>
</template>

<style scoped>
</style>