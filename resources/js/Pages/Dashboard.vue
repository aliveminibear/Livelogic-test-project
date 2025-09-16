<template>
  <Layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
          Choose Your Mini Application
        </h1>
        <p class="text-lg text-gray-600">
          Select one of the available applications to get started
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 gap-8">
        <!-- Todo List Option -->
        <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300">
          <div class="text-center">
            <div class="text-indigo-600 mb-6">
              <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">To-Do List</h2>
            <p class="text-gray-600 mb-6">
              Create and manage your tasks with priorities, due dates, and completion tracking.
            </p>
            <ul class="text-sm text-gray-500 mb-8 space-y-2">
              <li>✓ Add and delete tasks</li>
              <li>✓ Set priorities (High, Medium, Low)</li>
              <li>✓ Due date tracking</li>
              <li>✓ Mark tasks as complete</li>
              <li>✓ User-specific task lists</li>
            </ul>
            <Link
              href="/todos"
              class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200"
            >
              Open To-Do List
            </Link>
          </div>
        </div>
        
        <!-- Poll Creator Option -->
        <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300">
          <div class="text-center">
            <div class="text-gray-400 mb-6">
              <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Poll Creator</h2>
            <p class="text-gray-600 mb-6">Create a poll and share the link to collect votes.</p>
            <ul class="text-sm text-gray-400 mb-8 space-y-2">
              <li>• Create custom polls</li>
              <li>• Share poll links</li>
              <li>• Real-time voting</li>
              <li>• View results</li>
              <li>• User-specific polls</li>
            </ul>
            <div class="flex justify-center gap-3">
              <Link
                href="/polls/create"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200"
              >
                Create a Poll
              </Link>
              <Link
                href="/my-polls"
                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold px-8 py-3 rounded-lg transition duration-200"
              >
                My Polls
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../Components/Layout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
  const token = localStorage.getItem('token');
  if (!token) {
    window.location.href = '/login';
  }
});
</script>