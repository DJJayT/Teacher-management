import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/Sidebar-Responsive-2-ResponsiveSideBar-2.css',
                'resources/css/Sidebar-Responsive-2.css',
            ],
            refresh: true,
        }),
    ],
});
