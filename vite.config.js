import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    server: {
        host: '127.0.0.1',
        port: 12001,
        strictPort: true,
        cors: true,
        origin: 'http://127.0.0.1:12001',
        hmr: {
            host: '127.0.0.1',
            port: 12001,
            protocol: 'ws',
        },
    },
});
