<script setup>
// <script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { router, usePage } from "@inertiajs/vue3";
import axiosClient from "@/axiosClient.js";
import PostModal from "@/Components/app/PostModal.vue";
import InputTextarea from "../InputTextarea.vue";
import IndigoButton from "@/Components/app/IndigoButton.vue";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";

const showEditModal = ref(false);
const visibleDropdown = ref(null);

const props = defineProps({
    post: Object,
    index: Number
});

const authUser = usePage().props.auth.user;

const newCommentText = ref('');

function createComment(){
    axiosClient.post(route('post.comment.create', props.post), {
        comment: newCommentText.value
    })
    .then(({ data }) => {
        newCommentText.value = ''
        props.post.comments.unshift(data)
        props.post.num_of_comments++;
    })
};

const toggleDropdown = (index) => {
    visibleDropdown.value = visibleDropdown.value === index ? null : index;
};

function deletePost() {
    if (window.confirm('Are you sure want to delete this post?')) {
        router.delete(route('post.destroy', props.post), {
            preserveScroll: true
        });
    }
};

const confirmEdit = () => {
    const form = useForm({
        id: props.post.id,
        body: props.post.body
    });

    form.put(route('post.update', { post: props.post }), {
        onSuccess: () => {
            showEditModal.value = false;
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}

// Function to check if the attachment is an image
function checkImage(attachment) {
    const mime = attachment.mime.split('/');
    return mime[0].toLowerCase() === 'image';
}

function sendReaction() {
    axiosClient.post(route('post.reaction', props.post), {
        reaction: 'like'
    })
    .then(({ data }) => {
        props.post.current_user_has_reaction = data.current_user_has_reaction;
        props.post.num_of_reactions = data.num_of_reactions;
    })
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
                    <div class="info" @click="showEditModal.value = true">
                        <span>Edit</span>
                    </div>
                    <div class="info" @click="deletePost"><span>Delete</span></div>
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

        <Disclosure>
            <div>
                <button @click="sendReaction()"
                    class="rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    :class="[post.current_user_has_reaction ? 'bg-blue-600 hover:bg-indigo-500' : 'bg-indigo-600 hover:bg-indigo-500']">
                        {{ post.current_user_has_reaction ? 'Unlike' : 'Like' }}
                        <span> • {{ post.num_of_reactions }}</span>
                </button>

                <DisclosureButton
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Comment <span> • {{ post.num_of_comments }}</span>
                </DisclosureButton>
            </div>

            <DisclosurePanel class="mt-3 mb-3">
                <div>
                    <div class="flex gap-2 mb-3">
                        <a href="javascript:void(0)">
                            <img :src="authUser.avatar_url"
                            class="w-[40px] rounded-full border border-2 transition-all
                            hover:border-blue-500"/>
                        </a>
                        <div class="flex">
                            <InputTextarea v-model="newCommentText" placeholder="Tulis Komentar disini" rows="1"
                            class="max-h-[160px] resize-none rounded-r-none"></InputTextarea>
                            <IndigoButton @click="createComment" class="w-[100px] rounded-l-none">Submit</IndigoButton>
                        </div>    
                    </div>
                </div>
                <div v-for="comment of post.comments" :key="comment.id" class="mb-4">
                    <div class="flex gap-2">
                        <a href="javascript:void(0)">
                            <img :src="comment.user.avatar_url"
                            class="w-[40px] rounded-full border border-2 transition-all
                            hover:border-blue-500"/>
                        </a>
                        <div>
                        <h4 class="font-bold">
                            <a href="javascript:void(0)" class="hover:underline">
                                {{ comment.user.name }}
                            </a>
                        </h4>
                        <small class="text-xs text-gray-400">{{comment.updated_at}}</small>
                        </div>
                    </div>
                            <div class="text-sm flex flex-1 ml-12"
                            v-html="comment.comment ">
                            </div>
                </div> 
            </DisclosurePanel>
        </Disclosure>

        <PostModal :post="post" :show="showEditModal.value" @close="showEditModal.value = false" @confirm="confirmEdit">
            Edit Post
            <InputTextarea v-model="post.body" class="mb-3 w-full"></InputTextarea>
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
