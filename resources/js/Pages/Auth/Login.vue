<template>
  <Layout>
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
          Sign In
        </h2>
        
        <form @submit.prevent="login" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              Email Address
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
              :class="{ 'border-red-500': errors.email }"
            />
            <p v-if="errors.email" class="mt-1 text-sm text-red-600">
              {{ errors.email[0] }}
            </p>
          </div>
          
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              Password
            </label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
              :class="{ 'border-red-500': errors.password }"
            />
            <p v-if="errors.password" class="mt-1 text-sm text-red-600">
              {{ errors.password[0] }}
            </p>
          </div>
          
          <div v-if="errors.error" class="bg-red-50 border border-red-200 rounded-md p-3">
            <p class="text-sm text-red-600">{{ errors.error }}</p>
          </div>
          
          <button
            type="submit"
            :disabled="loading"
            class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-semibold py-2 px-4 rounded-md transition duration-200"
          >
            <span v-if="loading">Signing In...</span>
            <span v-else>Sign In</span>
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <Link href="/register" class="text-indigo-600 hover:text-indigo-800 font-medium">
              Sign up
            </Link>
          </p>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>

import Layout from '../../Components/Layout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';
import axios from 'axios';

const form = reactive({
  email: '',
  password: ''
});

const errors = ref({});
const loading = ref(false);

const login = async () => {
  loading.value = true;
  errors.value = {};
  
  try {
    const response = await axios.post('/api/auth/login', form);
    
    // Store token and user
    localStorage.setItem('token', response.data.access_token);
    if (response.data.user) {
      localStorage.setItem('user', JSON.stringify(response.data.user));
    }
    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;
    
    // Redirect to dashboard
    window.location.href = '/dashboard';
  } catch (error) {
    if (error.response?.status === 422) {
      errors.value = error.response.data;
    } else if (error.response?.status === 401) {
      errors.value = { error: 'Invalid credentials' };
    } else {
      errors.value = { error: 'An error occurred. Please try again.' };
    }
  } finally {
    loading.value = false;
  }
};
</script>