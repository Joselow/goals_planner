<script setup>
import { ref } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    }
})


let isVisibleCard = ref(false);

const handleClick = async () => {
    isVisibleCard.value = !isVisibleCard.value

    console.log(isVisibleCard.value);
    // console.log(isVisibleCard.value);
}

const borderColor = `2px solid ${props.category?.color}`

</script>

<template>
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
    </div>
</template>

<style scoped>
</style>