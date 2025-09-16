<template>
  <Layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">My Tasks</h1>
        <p class="text-gray-600">Organize and track your daily tasks</p>
      </div>
      
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Add New Task</h2>
        <form @submit.prevent="addTask" class="space-y-4">
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Task Title *
              </label>
              <input
                id="title"
                v-model="newTask.title"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                placeholder="Enter task title"
              />
            </div>
            <div>
              <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                Priority
              </label>
              <select
                id="priority"
                v-model="newTask.priority"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
              >
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
              </select>
            </div>
          </div>
          
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description
              </label>
              <textarea
                id="description"
                v-model="newTask.description"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                placeholder="Task description (optional)"
              ></textarea>
            </div>
            <div>
              <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                Due Date
              </label>
              <input
                id="due_date"
                v-model="newTask.due_date"
                type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
              />
            </div>
          </div>
          
          <button
            type="submit"
            :disabled="loading"
            class="bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-semibold px-6 py-2 rounded-md transition duration-200"
          >
            <span v-if="loading">Adding...</span>
            <span v-else>Add Task</span>
          </button>
        </form>
      </div>
      
      <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-center">
          <div class="flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700">Filter:</label>
            <select
              v-model="filter"
              class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              <option value="all">All Tasks</option>
              <option value="pending">Pending</option>
              <option value="completed">Completed</option>
              <option value="high">High Priority</option>
              <option value="overdue">Overdue</option>
            </select>
          </div>
          <div class="text-sm text-gray-600">
            Total: {{ filteredTasks.length }} tasks
          </div>
        </div>
      </div>
      
      <div class="space-y-4">
        <div
          v-for="task in filteredTasks"
          :key="task.id"
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200"
          :class="{
            'border-l-4 border-red-500': task.priority === 3,
            'border-l-4 border-yellow-500': task.priority === 2,
            'border-l-4 border-green-500': task.priority === 1,
            'opacity-75': task.completed
          }"
        >
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <button
                  @click="toggleTask(task)"
                  class="flex-shrink-0 w-5 h-5 rounded border-2 border-gray-300 flex items-center justify-center hover:border-indigo-500 transition duration-200"
                  :class="{
                    'bg-indigo-500 border-indigo-500': task.completed
                  }"
                >
                  <svg
                    v-if="task.completed"
                    class="w-3 h-3 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </button>
                <h3
                  class="text-lg font-semibold"
                  :class="{
                    'line-through text-gray-500': task.completed,
                    'text-gray-900': !task.completed
                  }"
                >
                  {{ task.title }}
                </h3>
                <span
                  class="px-2 py-1 text-xs font-medium rounded-full"
                  :class="{
                    'bg-red-100 text-red-800': task.priority === 3,
                    'bg-yellow-100 text-yellow-800': task.priority === 2,
                    'bg-green-100 text-green-800': task.priority === 1
                  }"
                >
                  {{ getPriorityText(task.priority) }}
                </span>
              </div>
              
              <p
                v-if="task.description"
                class="text-gray-600 mb-3"
                :class="{ 'line-through': task.completed }"
              >
                {{ task.description }}
              </p>
              
              <div class="flex items-center space-x-4 text-sm text-gray-500">
                <span v-if="task.due_date">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  Due: {{ formatDate(task.due_date) }}
                  <span
                    v-if="isOverdue(task)"
                    class="text-red-600 font-medium ml-1"
                  >
                    (Overdue)
                  </span>
                </span>
                <span>
                  Created: {{ formatDate(task.created_at) }}
                </span>
              </div>
            </div>
            
            <div class="flex items-center space-x-2 ml-4">
              <button
                @click="editTask(task)"
                class="text-indigo-600 hover:text-indigo-800 p-2 rounded-md hover:bg-indigo-50 transition duration-200"
                title="Edit task"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>
              <button
                @click="deleteTask(task)"
                class="text-red-600 hover:text-red-800 p-2 rounded-md hover:bg-red-50 transition duration-200"
                title="Delete task"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
        
        <div v-if="filteredTasks.length === 0" class="text-center py-12">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
          </svg>
          <h3 class="text-lg font-medium text-gray-900 mb-2">No tasks found</h3>
          <p class="text-gray-600">
            {{ filter === 'all' ? 'Create your first task to get started!' : 'No tasks match the current filter.' }}
          </p>
        </div>
      </div>
    </div>
    
    <div
      v-if="editingTask"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
      @click.self="cancelEdit"
    >
      <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Task</h3>
        <form @submit.prevent="updateTask" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Task Title *
            </label>
            <input
              v-model="editingTask.title"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Priority
            </label>
            <select
              v-model="editingTask.priority"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            >
              <option value="1">Low</option>
              <option value="2">Medium</option>
              <option value="3">High</option>
            </select>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Description
            </label>
            <textarea
              v-model="editingTask.description"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            ></textarea>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Due Date
            </label>
            <input
              v-model="editingTask.due_date"
              type="date"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
          </div>
          
          <div class="flex justify-end space-x-3 pt-4">
            <button
              type="button"
              @click="cancelEdit"
              class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition duration-200"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="loading"
              class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white rounded-md transition duration-200"
            >
              <span v-if="loading">Updating...</span>
              <span v-else>Update Task</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../Components/Layout.vue';
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';

const tasks = ref([]);
const loading = ref(false);
const filter = ref('all');
const editingTask = ref(null);

const newTask = reactive({
  title: '',
  description: '',
  priority: 2,
  due_date: ''
});

const filteredTasks = computed(() => {
  switch (filter.value) {
    case 'pending':
      return tasks.value.filter(task => !task.completed);
    case 'completed':
      return tasks.value.filter(task => task.completed);
    case 'high':
      return tasks.value.filter(task => task.priority === 3);
    case 'overdue':
      return tasks.value.filter(task => isOverdue(task) && !task.completed);
    default:
      return tasks.value;
  }
});

const fetchTasks = async () => {
  try {
    const response = await axios.get('/api/tasks');
    tasks.value = response.data;
  } catch (error) {
    console.error('Error fetching tasks:', error);
  }
};

const addTask = async () => {
  loading.value = true;
  try {
    const response = await axios.post('/api/tasks', newTask);
    tasks.value.unshift(response.data.task);
    
    // Reset form
    Object.assign(newTask, {
      title: '',
      description: '',
      priority: 2,
      due_date: ''
    });
  } catch (error) {
    console.error('Error adding task:', error);
  } finally {
    loading.value = false;
  }
};

const toggleTask = async (task) => {
  try {
    const response = await axios.post(`/api/tasks/${task.id}/toggle`);
    const index = tasks.value.findIndex(t => t.id === task.id);
    if (index !== -1) {
      tasks.value[index] = response.data.task;
    }
  } catch (error) {
    console.error('Error toggling task:', error);
  }
};

const editTask = (task) => {
  editingTask.value = { ...task };
};

const updateTask = async () => {
  loading.value = true;
  try {
    const response = await axios.put(`/api/tasks/${editingTask.value.id}`, editingTask.value);
    const index = tasks.value.findIndex(t => t.id === editingTask.value.id);
    if (index !== -1) {
      tasks.value[index] = response.data.task;
    }
    editingTask.value = null;
  } catch (error) {
    console.error('Error updating task:', error);
  } finally {
    loading.value = false;
  }
};

const cancelEdit = () => {
  editingTask.value = null;
};

const deleteTask = async (task) => {
  if (confirm('Are you sure you want to delete this task?')) {
    try {
      await axios.delete(`/api/tasks/${task.id}`);
      tasks.value = tasks.value.filter(t => t.id !== task.id);
    } catch (error) {
      console.error('Error deleting task:', error);
    }
  }
};

const getPriorityText = (priority) => {
  switch (priority) {
    case 3: return 'High';
    case 2: return 'Medium';
    case 1: return 'Low';
    default: return 'Medium';
  }
};

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString();
};

const isOverdue = (task) => {
  if (!task.due_date) return false;
  return new Date(task.due_date) < new Date() && !task.completed;
};

onMounted(() => {
  const token = localStorage.getItem('token');
  if (!token) {
    window.location.href = '/login';
    return;
  }
  
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  fetchTasks();
});
</script>