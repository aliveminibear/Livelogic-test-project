<template>
  <Layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">My Polls</h1>
        <Link href="/polls/create" class="px-4 py-2 bg-indigo-600 text-white rounded">New Poll</Link>
      </div>
      <div v-if="polls.length === 0" class="bg-white p-6 rounded shadow">You haven't created any polls yet.</div>
      <div v-else class="space-y-3">
        <div v-for="p in polls" :key="p.id" class="bg-white p-6 rounded shadow flex items-center justify-between">
          <div>
            <div class="font-semibold">{{ p.question }}</div>
            <div class="text-sm text-gray-500">Created {{ new Date(p.created_at).toLocaleString() }}</div>
          </div>
          <div class="flex gap-2">
            <Link :href="`/polls/${p.id}`" class="px-3 py-1 bg-gray-200 rounded">Open</Link>
            <Link :href="`/polls/${p.id}/results`" class="px-3 py-1 bg-gray-200 rounded">Results</Link>
          </div>
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

const polls = ref([]);

onMounted(async () => {
  const token = localStorage.getItem('token');
  if (!token) {
    window.location.href = '/login';
    return;
  }
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  const { data } = await axios.get('/api/my/polls');
  polls.value = data;
});
</script>

