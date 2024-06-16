<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import CommunityList from "@/Components/app/CommunityList.vue";
import SearchList from "@/Components/app/SearchList.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user;

defineProps({
    posts: Object
});
</script>

<template>
    <Head title="Home"/>
    <AuthenticatedLayout>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-3">
            <CommunityList/>
        </div>

        <div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            </div>
        </div>

        <div class="col-span-5">
            <CreatePost/>
            <PostList :posts="posts.data"/>
        </div>

        <div class="col-span-3">
            <SearchList/>
        </div>
    </div>
    </AuthenticatedLayout>
    
</template>
