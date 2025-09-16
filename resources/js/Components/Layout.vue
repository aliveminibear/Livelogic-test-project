<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <nav class="bg-white shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <Link href="/dashboard" class="text-xl font-bold text-indigo-600">
              TodoApp
            </Link>
          </div>
          <div class="flex items-center space-x-4">
            <template v-if="user">
              <span class="text-gray-700">Hello, {{ user.name }}!</span>
              <button
                @click="logout"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 cursor-pointer"
              >
                Logout
              </button>
            </template>
            <template v-else>
              <Link
                href="/login"
                class="text-indigo-600 hover:text-indigo-800 px-3 py-2 rounded-md"
              >
                Login
              </Link>
              <Link
                href="/register"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition duration-200"
              >
                Register
              </Link>
            </template>
          </div>
        </div>
      </div>
    </nav>
    
    <main class="py-8">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const user = ref(null);

const checkAuth = async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      user.value = null;
      return;
    }
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    const { data } = await axios.get('/api/auth/user-profile');
    user.value = data;
  } catch (error) {
    user.value = null;
    localStorage.removeItem('token');
    delete axios.defaults.headers.common['Authorization'];
  }
};

const logout = async () => {
  try {
    await axios.post('/api/auth/logout');
  } catch (e) {
  }
  localStorage.removeItem('token');
  delete axios.defaults.headers.common['Authorization'];
  user.value = null;
  window.location.href = '/';
};

onMounted(() => {
  checkAuth();
});
</script>