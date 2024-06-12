<script setup>
import CommunityList from '@/Components/app/CommunityList.vue';


const props = defineProps({
    community : Array,
    posts : Object
})

</script>

<template>
    <div class="grid-cols-1 sm:grid-cols-2">
        <div>
            <h2 class="text-lg font-bold">Community</h2>
            <div class="grid-cols-2">
                <CommunityItem v-for= "community of community " :community ="community " image="https://picsum.photos/100"
                       title="Seravim"
                       description="Lorem ipsum, halo kevin."/> 
            </div>
        </div>
    </div>



</template>