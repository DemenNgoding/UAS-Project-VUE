<script setup>
defineProps({
    post: Object
})

</script>

<template>
    <div>
        <div class="flex items-center gap-2">
            <a href="javascript:void(0)">
                <img :src="post.user.avatar" class="w-[45px] rounded-full">
            </a>
        </div>

        <div>
            <h4>
                <a href="javascript:void(0)">
                    {{ post.user.name }}
                </a>
            </h4>
            <small>{{ post.created_at }}</small>
        </div>

        <!--        caption-->
        <div v-html="post.body"></div>
    </div>
</template>

<style scoped>

</style>
