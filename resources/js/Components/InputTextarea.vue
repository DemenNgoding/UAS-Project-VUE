<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const props = defineProps({
    placeholder: String,
    autoResize: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue']);

const autoResizeTextArea = ref(null)
const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

function onInputChange($event){
    emit('update:modelValue', $event.target.value)

    if(props.autoResize){
        input.value.style.height = 'auto';
        input.value.style.height = textarea.scrollHeight + 'px';
    }
}

</script>

<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="model"
        @input="onInputChange"
        ref="input"
        :placeholder = "placeholder"
    />
</template>
