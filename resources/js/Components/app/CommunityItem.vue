<script setup>
    defineProps({
        image: String,
        title: String,
        description: String
    })
</script>

<template>
    <div class="flex items-start">
        <img :src="image">
        <div>
            <h3 class="font-black text-xl">{{ title }}</h3>
            <div>{{ description }}</div>
        </div>
    </div>
    <br>
    <br>
    <button
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Add Community
    </button>
</template>

<style scoped>

</style>
