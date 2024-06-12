<script setup>
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <div>
        <pre>{{user}}</pre>
    </div>
</template>

<style scoped>

</style>