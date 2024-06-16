<script setup>
import PostModal from "@/Components/app/PostModal.vue";
import { ref } from "vue";
import InputTextarea from "../InputTextarea.vue";
import {useForm} from "@inertiajs/vue3";
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const visibleDropdown = ref(null);

const toggleDropdown = (index) => {
    visibleDropdown.value = visibleDropdown.value === index ? null : index;
};

const confirmEdit = () => {   
    const form = useForm({
        id: post.id,
        body: post.body
    });

    form.put(route('post.update', { post }), {
        onSuccess: () => {
            showEditModal = false;
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}

defineProps({
    post: Object,
    index: Number
});

// this function is to check
function checkImage(attachment) {
    const mime = attachment.mime.split('/');
    return mime[0].toLowerCase() === 'image';
}
</script>

<template>
    <div class="bg-white border rounded p-4 mb-3">
        <div class="flex items-center justify-between gap-2 mb-3">
            <a href="javascript:void(0)">
                <img :src="post.user.avatar_url" 
                    class="w-[45px] rounded-full border border-2 transition-all hover:border-blue-500"/>
            </a>

             <div class="relative">
                <div class="group-menu" @click="toggleDropdown(index)">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>

                <div v-if="visibleDropdown === index" class="frame">
                    <div class="info" @click="() => showEditModal = true">
                        <span>Edit</span>
                    </div>
                    <div class="info" @click="() => DeletePost = true"><span>Delete</span></div>
                    <div class="info" @click="toggleDropdown(index)"><span>Exit</span></div>
                </div>
             </div>
        </div>

        <div>
            <h4 class="font-bold">
                <a href="javascript:void(0)" class="hover:underline">
                    {{ post.user.name }}
                </a>
            </h4>
            <small>{{ post.updated_at }}</small>
        </div>

        <!-- caption -->
        <div v-html="post.body"></div>
        <br>

        <div class="grid grid-cols-2 gap-3">
            <div v-for="attachment of post.attachment" :key="attachment.id">
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

        <PostModal :post="post" :show="showEditModal" @close="showEditModal = false" @confirm="confirmEdit">
            Edit Post
            <InputTextarea v-model="post.body"
                class="mb-3 w-full">

            </InputTextarea>
        </PostModal>

        <PostModal :show="DeletePost" @close="showDeleteModal = false" @confirm="confirmDelete">
            <h2>Are you sure you want to delete this post?</h2>
        </PostModal>
    </div>
</template>

<style scoped>
    .container{
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .group-menu{
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .dot{
        width: 5px;
        height: 5px;
        background-color: black;
        border-radius: 50%;
        margin-top: 4px;
    }

    .frame{
        position: absolute;
        top: 100%;
        right: 0;
        background-color: rgb(101, 52, 226);
        border-radius: 10px;
        overflow: hidden;
        z-index: 10;
    }

    .frame .info{
        font-size: 15px;
        color: white;
        padding: 10px;
        cursor: pointer;
        text-align: center;
    }

    .frame .info:hover{
        background-color: #363333;
    }
</style>
