<script setup>
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";
import Searchitem from "@/Components/app/Searchitem.vue";

const searchMyCommunity = ref('')
</script>

<template>
    <h2 class="font-black text-xl">Search Community</h2>

    <!--    form untuk mencari community yang kita join-->
    <text-input :model-value="searchMyCommunity" placeholder="Searh Community"/>

    <div>

        <!--                create list of community-->
        <Searchitem image="https://picsum.photos/100"
                    title="Seravim"
                    description="Lorem ipsum, dolor sit amet consectetur adipisicing elit."/>


    </div>
</template>

<style scoped>

</style>
