
<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import CommunityItem from "@/Components/app/CommunityItem.vue";
import TextInput from "@/Components/TextInput.vue";

const searchMyCommunity = ref('');
const showAddCommunityForm = ref(false);
const communityName = ref('');
const communityDescription = ref('');

const toggleAddCommunityForm = () => {
    showAddCommunityForm.value = !showAddCommunityForm.value;
};

const form = useForm({
    name: '',
    about: '',
    auto_approval: true,
});

const addCommunity = () => {
    form.post(route('community.create'), {
        onSuccess: () => {
            showAddCommunityForm.value = false;
            form.reset();
        }
    });
};
</script>

<template>
        <div>
            <button @click="toggleAddCommunityForm"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-4">
                Add Community
            </button>

            <div v-if="showAddCommunityForm" class="mt-4">
                <h3 class="font-black text-xl">Add a New Community</h3>
                <TextInput v-model="form.name" placeholder="Community Name" class="mt-2"/>
                <TextInput v-model="form.about" placeholder="Community Description" class="mt-2"/><br>
                <input type="checkbox" id="auto_approval" v-model="form.auto_approval" />
                <label for="checkbox">Anyone can join</label><br>
                <button @click="addCommunity"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm
                         font-semibold text-white shadow-sm hover:bg-green-500 
                         focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                         focus-visible:outline-green-600 mt-4">
                    Submit
                </button>
            </div>
        </div>
    <!-- </div> -->
</template>
