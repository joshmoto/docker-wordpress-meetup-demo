import {defineConfig} from "vite";
import laravel from 'laravel-vite-plugin';

export default defineConfig(() => ({
    base: '',
    build: {
        emptyOutDir: true,
        manifest: true,
        outDir: 'build',
        assetsDir: 'assets'
    },
    plugins: [
        laravel({
            publicDirectory: 'build',
            input: [
                'resources/js/admin.js',
                'resources/js/login.js',
                'resources/js/theme.js',
                'resources/scss/admin.scss',
                'resources/scss/login.scss',
                'resources/scss/theme.scss'
            ],
            refresh: [
                '**.php'
            ]
        })
    ],
    resolve: {
        alias: [
            {
                find: /~(.+)/,
                replacement: process.cwd() + '/node_modules/$1'
            },
        ]
    }
}));
