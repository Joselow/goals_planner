<script setup>
import { ref } from 'vue';


const props = defineProps({
    progress: {
        type: Number,
        required: true,
    },
    color: {
        type: String,
        default: '#3b82f6', // Default to blue-600
    },
    height: {
        type: Number,
        default: 'h-4', // Default height
    },
    data: {
        type: Object,
        default: () => ({ name: '' }), // Default to an empty object
    },
})

const showPercentage = ref(false)

</script>

<template>
    <div class="my-2 relative w-full rounded-full bg-gray-200 dark:bg-gray-700"
        :class="height"
    >
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 cursor-pointer"
            :class="height"
        >
            <div class="relative text-end bg-blue-600 rounded-full" :style="{ width: `${progress ?? 0}%`, background:  color}"
                :class="height"
                
                @mouseenter="showPercentage = true"
                @mouseleave="showPercentage = false"
            >   
                <span v-if="progress > 0" class="absolute top-0 right-3 text-xs font-bold text-white inline-block">
               
                    {{ progress??0 }} %
                </span>
            </div>
        </div>

        <div v-show="showPercentage" class="text-center transition-all absolute top-0 left-0 flex items-center justify-center w-full h-full">
            <p  class="rounded-lg px-16 py-2 text-3xl font-bold text-white mt-1"
                :style="{ background: color }"
            >
                 {{ data.name }}
                 <br>
            {{ progress??0 }}%</p>
        </div>
    </div>
</template>

<style scoped>
</style>