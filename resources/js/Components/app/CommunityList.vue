<script setup>
import { ref } from 'vue';
import CommunityItem from "@/Components/app/CommunityItem.vue";
import TextInput from "@/Components/TextInput.vue";

const searchMyCommunity = ref('');
const showAddCommunityForm = ref(false);
const communityName = ref('');
const communityDescription = ref('');

const toggleAddCommunityForm = () => {
    showAddCommunityForm.value = !showAddCommunityForm.value;
};

const addCommunity = () => {
    console.log('Community Name:', communityName.value);
    console.log('Community Description:', communityDescription.value);

    showAddCommunityForm.value = false;
};
</script>

<template>
    <h2 class="font-black text-xl">My Community</h2>

    <TextInput v-model="searchMyCommunity" placeholder="Search My Community"/>

    <div v-if="false">
        You are not a member of any community.
    </div>
    
    <div v-else>
        <CommunityItem
            image="https://picsum.photos/100"
            title="Seravim"
            description="Lorem ipsum, dolor sit amet consectetur adipisicing elit."
        />

        <br>
        <br>
        <button @click="toggleAddCommunityForm"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-4">
            Add Community
        </button>

        <div v-if="showAddCommunityForm" class="mt-4">
            <h3 class="font-black text-xl">Add a New Community</h3>
            <TextInput v-model="communityName" placeholder="Community Name" class="mt-2"/>
            <TextInput v-model="communityDescription" placeholder="Community Description" class="mt-2"/>
            <button @click="addCommunity"
                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 mt-4">
                Submit
            </button>
        </div>
    </div>
</template>

<style scoped>
</style>

