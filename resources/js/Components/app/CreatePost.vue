<script setup>
import {ref} from "vue";
import InputTextarea from "@/Components/InputTextarea.vue";
import {useForm, usePage} from "@inertiajs/vue3";

const createPost = ref(false)

const newPostForm = useForm({
    body: '',
});

function submit(){
    newPostForm.post(route('post.create')), {
        onSuccess: () => {
            newPostForm.reset()
        }
    }
}

</script>

<template>
    <div class="py-6">
        <InputTextarea  @click="createPost = true" class="border rounded py-3 px-12 mb-3" 
            placeholder="Create New Post" rows = "1" v-model="newPostForm.body"/>
            <pre>{{ newPostForm.body }}</pre>
        </div>

        <div v-if="createPost" class="flex justify-between gap-2">
            <!--            untuk memasukan foto sebagai post-->
            <button type="button"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 relative focus-visible:outline-indigo-600">
                Attach File
                <input type="file" class="absolute left-0 right-0 top-0 bottom-0 opacity-0">
            </button>
            <!--            Button post untuk posting postnya-->
            <button @click="submit" type="submit"
                    class="rounded-md bg-indigo-600 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Post
            </button>
        </div>
</template>

<style scoped>

</style>
