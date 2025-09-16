import '../css/app.css';

import { createApp, h } from 'vue';

console.log('App script loaded');

const app = createApp({
    setup() {
        console.log('Vue app setup called');
        return () => h('div', { class: 'p-8' }, [
            h('h1', { class: 'text-2xl font-bold' }, 'Vue.js is working!'),
            h('p', 'This is a simple test without Inertia.js')
        ]);
    }
});

app.mount('#app');
console.log('Vue app mounted');