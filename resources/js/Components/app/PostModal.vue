<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  show: Boolean,
  post: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close']);

const close = () => emit('close');

function confirm(){
  const form = useForm({
    id: props.post.id,
    body: props.post.body
  })

  form.put(route('post.update', props.post),{
    preserveScroll: true,
    onSuccess: () => {
      emit('close')
    }
  })
}
</script>

<template>
    <div v-if="show" class="modal-backdrop">
      <div class="modal">
        <slot></slot>
        <div class="modal-actions">
          <button @click="confirm()"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 relative focus-visible:outline-indigo-600">
              Confirm
          </button>

          <button @click="close"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 relative focus-visible:outline-indigo-600">
              Cancel
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <style scoped>
  .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
  }
  
  .modal-actions {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
  }
  </style>
