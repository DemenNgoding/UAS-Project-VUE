<script setup>
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <a href="/dashboard">
        <button
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Back
        </button>
    </a>
    <br>
    <div class="relative">
        <img src="https://static.vecteezy.com/system/resources/previews/021/548/095/original/default-profile-picture-avatar-user-avatar-icon-person-icon-head-icon-profile-picture-icons-default-anonymous-user-male-and-female-businessman-photo-placeholder-social-network-avatar-portrait-free-vector.jpg"
            class="absolute-left-[100px] w-[128px] h-[128px] b-0"> 
        <br>
        <pre>Name   : {{ user.name }}</pre>
        <pre>Email  : {{ user.email }}</pre>
    </div>
    <br>
    <a href="/profile">
        <button
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Edit Profile 
        </button>
    </a>
    
</template>

<style lang="scss" scoped>

</style>