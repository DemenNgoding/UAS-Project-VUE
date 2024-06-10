<script setup>
import CommunityItem from "@/Components/app/CommunityItem.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";

const searchCommunity = ref('')
</script>

<template>
    <h2 class="font-black text-xl">Search Community</h2>

    <!--    form untuk mencari community yang kita join-->
    <text-input :model-value="searchCommunity" placeholder="Search Community"/>

    <div>

    </div>

</template>

<style scoped>

</style>
