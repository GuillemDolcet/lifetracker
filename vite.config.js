// -- vite.config.js

import path from 'path';
import { existsSync, readFileSync } from 'fs';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import manifestSRI from 'vite-plugin-manifest-sri';
import fsExtra from 'fs-extra';
import fg from 'fast-glob';

const inProduction = process.env.NODE_ENV === 'production';

// -- Custom inline plugin definitions

//Clean public assets folder if working in local
const assetCleanup = function (dirs = []) {
    return {
        name: "vite-plugin-asset-cleanup",
        apply: "build",
        enforce: "post",
        async writeBundle() {
            if (!inProduction) {
                return;
            }

            const manifestPath = path.resolve(__dirname, 'public/assets/manifest.json');
            if (!existsSync(manifestPath)) {
                return;
            }

            const manifest = JSON.parse(readFileSync(manifestPath));

            const exceptions = [
                '!public/assets/fonts/.gitignore',
                '!public/assets/images/.gitignore',
                '!public/assets/javascripts/.gitignore',
                '!public/assets/stylesheets/.gitignore',
                '!public/assets/manifest.json',
                ...Object.values(manifest).map(chunk => path.resolve(__dirname, `public/assets/${chunk.file}`))
            ];

            const deletes = [
                'public/assets/fonts/*',
                'public/assets/images/*',
                'public/assets/javascripts/*',
                'public/assets/stylesheets/*',
                ...dirs,
            ];

            // Prune all supplied files/folders except those present in the manifest
            for (const pattern of deletes) {
                const files = await fg(pattern, { absolute: true });
                for (const file of files) {
                    if (!exceptions.includes(file)) {
                        await fsExtra.remove(file);
                    }
                }
            }
        }
    }
}

// -- Vite.js configuration

export default defineConfig({
    plugins: [
        // Laravel Vite.js plugin config
        laravel({
            hotFile: 'storage/app/vite.hot',
            buildDirectory: 'assets',

            input: [
                'resources/assets/stylesheets/application.scss',
                'resources/assets/javascripts/application.js',
            ],
            refresh: true,
        }),
        // Build-up source files resource integrity computations on the manifest...
        manifestSRI(),
        // Perform old hashed asset cleanup...
        assetCleanup(),
    ],
    build: {
        sourcemap: !inProduction,
        manifest: "manifest.json",
        reportCompressedSize: true,
        emptyOutDir: false,
        rollupOptions: {
            output: {
                chunkFileNames: 'javascripts/[name].[hash].js',
                entryFileNames: 'javascripts/[name].[hash].js',
                assetFileNames: ({ name }) => {
                    if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
                        return 'images/[name].[hash][extname]'
                    }

                    if (/\.css$/.test(name ?? '')) {
                        return 'stylesheets/[name].[hash][extname]'
                    }

                    if (/\.(ttf|woff|woff2|eot)$/.test(name ?? '')) {
                        return 'fonts/[name].[hash][extname]'
                    }
                    return '[name].[hash][extname]'
                },
            }
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true
        }
    }
})
