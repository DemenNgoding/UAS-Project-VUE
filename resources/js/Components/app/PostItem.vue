<script setup>
defineProps({
    post: Object
})

// this function is to check
function checkImage(attachment) {
    const mime = attachment.mime.split('/')
    return mime[0].toLowerCase() === 'image'
}

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

        <div class="grid grid-cols-2 gap-3">
            <div v-for="attachment of post.attachment">
                <img v-if="checkImage(attachment)" :src="attachment.url">
            </div>
        </div>

        <div>
            <button
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Like
            </button>

            <button
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Comment
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
