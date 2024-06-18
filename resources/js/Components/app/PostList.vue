<script setup>
import PostItem from "@/Components/app/PostItem.vue";

defineProps({
    posts: Array
})

const post1 = {
    user: {
        id: 1,
        avatar: 'https://picsum.photos/100',
        name: 'yan'
    },

    community: null,

    attachment: [
        {
            id: 1,
            name: 'test.png',
            url: 'https://picsum.photos/100',
            mime: 'image/png'
        }
    ],

    body:
        '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>',

    created_at: '0000-1-1',


}
</script>

<template>
    <div>
        <PostItem v-for="post of posts" :key="post.id" :post="post"/>
    </div>
</template>

<style scoped>

</style>
