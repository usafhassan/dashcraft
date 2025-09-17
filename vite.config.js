import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        host: '127.0.0.1',
        port: 5173,
        middlewareMode: false,
    },
    css: {
        devSourcemap: true,
    },
});