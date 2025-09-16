<template>
  <Layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Create a Poll</h1>
        <form @submit.prevent="createPoll" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Question</label>
            <input v-model="question" type="text" required class="w-full px-3 py-2 border rounded-md" placeholder="What's your question?" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
            <div v-for="(opt, idx) in options" :key="idx" class="flex items-center space-x-2 mb-2">
              <input v-model="options[idx]" type="text" required class="flex-1 px-3 py-2 border rounded-md" placeholder="Option" />
              <button type="button" class="px-2 py-1 bg-red-500 text-white rounded" @click="removeOption(idx)" v-if="options.length > 2">X</button>
            </div>
            <button type="button" class="px-3 py-1 bg-gray-200 rounded" @click="addOption">Add option</button>
          </div>
          <button type="submit" :disabled="loading" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white rounded">
            <span v-if="loading">Creating...</span>
            <span v-else>Create</span>
          </button>
          <p v-if="error" class="text-red-600">{{ error }}</p>
        </form>
        <div v-if="pollLink" class="mt-4 p-3 bg-green-50 rounded border border-green-200">
          <p class="text-sm">Share this link:</p>
          <a :href="pollLink" class="text-indigo-600 underline">{{ pollLink }}</a>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../../Components/Layout.vue';
import { ref } from 'vue';
import axios from 'axios';

const question = ref('');
const options = ref(['', '']);
const loading = ref(false);
const error = ref('');
const pollLink = ref('');

const addOption = () => options.value.push('');
const removeOption = (idx) => options.value.splice(idx, 1);

const createPoll = async () => {
  error.value = '';
  loading.value = true;
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      window.location.href = '/login';
      return;
    }
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    const payload = { question: question.value, options: options.value.filter(o => o.trim().length) };
    const { data } = await axios.post('/api/polls', payload);
    pollLink.value = `/polls/${data.poll.id}`;
  } catch (e) {
    error.value = 'Failed to create poll';
  } finally {
    loading.value = false;
  }
};
</script>

