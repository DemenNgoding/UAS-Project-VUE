<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import CommunityList from "@/Components/app/CommunityList.vue";
import SearchList from "@/Components/app/SearchList.vue";
import AddCommunity from "@/Components/app/AddCommunity.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";

defineProps({
    posts: Object
});
</script>

<template>
    <Head title="Home"/>

    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-3">
            <AddCommunity/>
        </div>

        <div class="col-span-6">
            <CreatePost/>
            <PostList :posts="posts.data"/>
        </div>

        <div class="col-span-3">
            <SearchList/>
        </div>

        <div class="col-span-3">
            <CommunityList/>
        </div>
    </div>
</template>
