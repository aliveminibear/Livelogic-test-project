<template>
  <Layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">
          Welcome to TodoApp
        </h1>
        <p class="text-xl text-gray-600 mb-12">
          A modern, feature-rich todo application built with Laravel and Vue.js
        </p>
        
        <div class="grid md:grid-cols-2 gap-8 mb-12">
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-indigo-600 mb-4">
              <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Task Management</h3>
            <p class="text-gray-600">Create, organize, and track your tasks with priorities and due dates.</p>
          </div>
          
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-indigo-600 mb-4">
              <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Secure Authentication</h3>
            <p class="text-gray-600">JWT-based authentication keeps your data safe and secure.</p>
          </div>
        </div>
        
        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
          <Link
            href="/register"
            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200"
          >
            Get Started
          </Link>
          <Link
            href="/login"
            class="inline-block bg-white hover:bg-gray-50 text-indigo-600 font-semibold px-8 py-3 rounded-lg border border-indigo-600 transition duration-200"
          >
            Sign In
          </Link>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../Components/Layout.vue';
import { Link } from '@inertiajs/vue3';
</script>