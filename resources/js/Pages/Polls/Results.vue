<template>
  <Layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-md p-6" v-if="poll">
        <h1 class="text-2xl font-bold mb-4">Results: {{ poll.question }}</h1>
        <div class="space-y-3">
          <div v-for="row in totals" :key="row.id">
            <div class="flex justify-between text-sm mb-1">
              <span>{{ row.text }}</span>
              <span>{{ row.votes }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded h-3">
              <div class="bg-indigo-600 h-3 rounded" :style="{ width: pct(row.votes) + '%' }"></div>
            </div>
          </div>
        </div>
        <div class="mt-4 text-sm text-gray-600">Total votes: {{ total }}</div>
        <div class="mt-4">
          <Link :href="`/polls/${id}`" class="text-indigo-600 underline">Back to vote</Link>
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
const totals = ref([]);
const total = ref(0);

onMounted(async () => {
  const { data } = await axios.get(`/api/polls/${id}/results`);
  poll.value = data.poll;
  totals.value = data.totals;
  total.value = data.total_votes;
});

const pct = (v) => {
  if (!total.value) return 0;
  return Math.round((v / total.value) * 100);
};
</script>

