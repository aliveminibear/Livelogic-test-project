<template>
  <Layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-md p-6" v-if="poll">
        <h1 class="text-2xl font-bold mb-4">{{ poll.question }}</h1>
        <form @submit.prevent="submitVote" class="space-y-3">
          <div v-for="opt in poll.options" :key="opt.id" class="flex items-center space-x-2">
            <input type="radio" :id="'opt-'+opt.id" v-model="selected" :value="opt.id" required />
            <label :for="'opt-'+opt.id">{{ opt.text }}</label>
          </div>
          <button type="submit" :disabled="loading" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white rounded">
            <span v-if="loading">Submitting...</span>
            <span v-else>Vote</span>
          </button>
          <p v-if="error" class="text-red-600">{{ error }}</p>
        </form>
        <div class="mt-4">
          <Link :href="`/polls/${id}/results`" class="text-indigo-600 underline">View results</Link>
        </div>
      </div>
    </div>
  </Layout>
  
</template>

<script setup>
import Layout from '../../Components/Layout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({ id: [String, Number] });
const id = props.id;

const poll = ref(null);
const selected = ref(null);
const loading = ref(false);
const error = ref('');

onMounted(async () => {
  const { data } = await axios.get(`/api/polls/${id}`);
  poll.value = data;
});

const submitVote = async () => {
  loading.value = true;
  error.value = '';
  try {
    const { data } = await axios.post(`/api/polls/${id}/vote`, { poll_option_id: selected.value });
    window.location.href = `/polls/${id}/results`;
  } catch (e) {
    error.value = e.response?.data?.error || 'Failed to vote';
  } finally {
    loading.value = false;
  }
};
</script>

