<script setup>
import { ref, computed, provide } from 'vue';

import FormGoal from '../Goal/FormGoal.vue';
import Goals from '../Goal/Goals.vue';

import { useGoal } from '../../composables/useGoal';


const { goals, getGoals, loader } = useGoal()



const props = defineProps({
    category: {
        type: Object,
        required: true,
    }
})

provide('category', props.category)

let isVisibleCard = ref(false);

let goalsRequested = false

const handleClick = async () => {
    isVisibleCard.value = !isVisibleCard.value

    if (!goalsRequested)  {
       reloadGoals()
    }

    goalsRequested = true
    console.log(isVisibleCard.value);
    // console.log(isVisibleCard.value);
}

const borderColor = computed(() => {
    return `2px solid ${props.category?.color}`
}) 

const reloadGoals = async () => {
  getGoals({ categoryId: props.category.id })
}

</script>

<template>

    <Loader v-if="loader" />

    <div class="w-full  rounded-md border px-6 py-2 cursor-pointer"
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
            @stored="reloadGoals"
        >
            {{ goals.length }}
        </FormGoal>

      
        <template
             v-for="(goal, index) in goals"
                 :key="index"
        >
            <Goals
                :goal="goal"
                @deleted="reloadGoals"
            />
        </template>
    </div>
</template>

<style scoped>
</style>