const mix = require('laravel-mix');
const { execSync } = require('child_process');

mix.browserSync({
    proxy: 'http://localhost:8000',
    files: [
        'app/**/*.php',
        'resources/views/**/*.blade.php',
        'public/mix/backend/js/app.js',
    ],
    open: false,
    notify: false,
    ui: false,
    injectChanges: true
});

// // APP BUNDLE CSS
// mix.scripts([
//     'public/assets/backend/fonts/inter.css',
//     'public/assets/backend/vendors/apexcharts/apexcharts.css',
//     'public/assets/backend/vendors/keenicons/styles.bundle.css',
//     'public/assets/backend/css/styles.css',
//     'public/assets/backend/css/flatpickr.min.css',
// ], 'public/assets/backend/mix/css/app-core.css').version();

// // APP BUNDLE JS
// mix.scripts([
//     'public/assets/backend/js/core.bundle.js',
//     'public/assets/backend/vendors/ktui/ktui.min.js',
//     'public/assets/backend/js/jquery-3.7.1.min.js',
//     'public/assets/backend/js/flatpickr.js',
//     'public/assets/backend/js/lazy-loader.js',
//     'public/assets/backend/js/core.plugins.js',
//     'public/assets/backend/js/logout.js',
// ], 'public/assets/backend/mix/js/app-core.js').version();

// // DATATABLE BUNDLE
// mix.scripts([
//     'resources/assets/backend/datatables/plugins/dataTables.min.js',
//     'resources/assets/backend/datatables/plugins/select.min.js',
//     'resources/assets/backend/datatables/plugins/buttons.min.js',
//     'resources/assets/backend/datatables/plugins/buttons.html5.min.js',
//     'resources/assets/backend/datatables/plugins/buttons.print.min.js',
//     'resources/assets/backend/datatables/plugins/jszip.min.js',
//     'resources/assets/backend/datatables/plugins/pdfmake.min.js',
//     'resources/assets/backend/datatables/plugins/vfs_fonts_custom.js',
//     'resources/assets/backend/datatables/datatable-function.js',
// ], 'public/assets/backend/mix/js/exilednoname-dt-plugins.js').version();

// // DATATABLE PAGES - OBFUSCATOR
// mix.then(() => {
//     execSync('npx javascript-obfuscator resources/assets/backend/datatables/datatable-index.js --output public/assets/backend/mix/js/exilednoname-dt-index.js --compact true --control-flow-flattening true', { stdio: 'inherit' });
//     execSync('npx javascript-obfuscator resources/assets/backend/datatables/datatable-form.js --output public/assets/backend/mix/js/exilednoname-dt-form.js --compact true --control-flow-flattening true', { stdio: 'inherit' });
//     execSync('npx javascript-obfuscator resources/assets/backend/datatables/datatable-trash.js --output public/assets/backend/mix/js/exilednoname-dt-trash.js --compact true --control-flow-flattening true', { stdio: 'inherit' });
//     execSync('npx javascript-obfuscator resources/assets/backend/datatables/datatable-optimization.js --output public/assets/backend/mix/js/exilednoname-dt-optimization.js --compact true --control-flow-flattening true', { stdio: 'inherit' });
//     console.log('EXILEDNONAME-LOG: Obfuscation completed!');
// });