<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import CommunityList from "@/Components/app/CommunityList.vue";
import SearchList from "@/Components/app/SearchList.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";
</script>

<template>
    <Head title="Home"/>

    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-3">
            <CommunityList/>
        </div>

        <div class="col-span-6">
            <CreatePost/>
            <PostList/>
        </div>

        <div class="col-span-3">
            <SearchList/>
        </div>
    </div>
</template>
