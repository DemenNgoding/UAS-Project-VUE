<script setup>
import CommunityItem from "@/Components/app/CommunityItem.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";

const searchMyCommunity = ref('')
</script>

<template>
    <h2 class="font-black text-xl">My Community</h2>

    <!--    form untuk mencari community yang kita join-->
    <text-input :model-value="searchMyCommunity" placeholder="Search My Community"/>

    <div v-if="false">
        you are not join any community
    </div>
    
    <div v-else>

        <!--                create list of community-->
        <CommunityItem image="https://picsum.photos/100"
                       title="Seravim"
                       description="Lorem ipsum, dolor sit amet consectetur adipisicing elit."/>


    </div>
</template>

<style scoped>

</style>
