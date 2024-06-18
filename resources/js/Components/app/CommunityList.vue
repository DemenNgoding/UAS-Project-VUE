<!-- <script setup>
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
    route(community.create);

    showAddCommunityForm.value = false;
};
</script> -->

<!-- <template>
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

    <div>
        <button @click="toggleAddCommunityForm"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-4">
            Add Community
        </button>

        <div v-if="showAddCommunityForm" class="mt-4">
            <h3 class="font-black text-xl">Add a New Community</h3>
            <TextInput v-model="communityName" placeholder="Community Name" class="mt-2"/>
            <TextInput v-model="communityDescription" placeholder="Community Description" class="mt-2"/><br>
            <input type="checkbox" id="auto_approval" value="Auto Approval" /><br>
            <label for="checkbox">{{ checked }}</label><br>
            <button @click="addCommunity"
                    class="rounded-md bg-green-600 px-3 py-2 text-sm
                     font-semibold text-white shadow-sm hover:bg-green-500 
                     focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 
                     focus-visible:outline-green-600 mt-4">
                     
                Submit
            </button>
        </div>
    </div>
    </div>
</template> -->

<script>
    // import { ref } from 'vue';
    // import { useForm } from '@inertiajs/vue3';
    // import CommunityItem from "@/Components/app/CommunityItem.vue";
    // import TextInput from "@/Components/TextInput.vue";

    // const searchMyCommunity = ref('');
    // const showAddCommunityForm = ref(false);
    // const communityName = ref('');
    // const communityDescription = ref('');
    import { ref, onMounted } from 'vue';
    import CommunityItem from "@/Components/app/CommunityItem.vue";
    import TextInput from "@/Components/TextInput.vue";

    export default {
        components: {
            CommunityItem,
            TextInput,
        },
        setup() {
            const searchMyCommunity = ref('');
            const communities = ref([]);
            const showAddCommunityForm = ref(false);
            const communityName = ref('');
            const communityDescription = ref('');

            const fetchCommunities = async () => {
                try {
                    const response = await fetch('/communities'); // Adjust the URL as needed
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();
                    communities.value = data;
                } catch (error) {
                    console.error('Failed to fetch communities', error);
                }
            };

            onMounted(() => {
                fetchCommunities();
            });

            return {
                // searchMyCommunity,
                // showAddCommunityForm,
                communityName,
                communityDescription,
                communities,
            };
        },
    };

</script>

<template>
    <h2 class="font-black text-xl">My Community</h2>

    <TextInput v-model="searchMyCommunity" placeholder="Search My Community"/>

    <div v-if="communities.length === 0">
        You are not a member of any community.
    </div>
    
    <div v-else>
        <!-- <CommunityItem
            image="https://picsum.photos/100"
            title="Seravim"
            description="Lorem ipsum, dolor sit amet consectetur adipisicing elit."
        /> -->
        <div v-for="community in communities" :key="community.id">
            <CommunityItem
                :image="community.image || 'https://picsum.photos/100'"
                :title="community.name"
                :description="community.about"
            />
        </div>
    </div>
</template>