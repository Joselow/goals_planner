<script setup>
    console.log('Hola mundo desde Vue 3');


const handleRequest = async () => {
    try {
        const response = await fetch(location.origin+'/goals',{
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': decodeURIComponent(document.cookie.match(/XSRF-TOKEN=([^;]+)/)[1]) 
            },
            credentials: 'include'
        })

        if (!response.ok) {
            throw new Error('Algo salio mal')
        }

        const data = await response.json()

        console.log(data);

    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <h1 class="title text-xl font-bold text-gray-100">GOALS</h1>
    <!-- <div class="bg-red-500">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti repellendus ab voluptatum consequatur provident impedit, explicabo repellat distinctio optio facilis nostrum laborum, hic facere, tenetur in laudantium et incidunt? Nesciunt?
    </div> -->
    <button class="rounded-md my-1 mx-2 bg-indigo-500 px-4"
        @click="handleRequest"
    >Button</button>
</template>

<style >

</style>