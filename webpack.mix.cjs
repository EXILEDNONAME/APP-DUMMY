const mix = require('laravel-mix');

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

// APP BUNDLE CSS
mix.scripts([
    'public/assets/backend/fonts/inter.css',
    'public/assets/backend/vendors/apexcharts/apexcharts.css',
    'public/assets/backend/vendors/keenicons/styles.bundle.css',
    'public/assets/backend/css/styles.css',
    'public/assets/backend/css/flatpickr.min.css',
], 'public/assets/backend/mix/css/app-core.css');

// APP BUNDLE JS
mix.scripts([
    'public/assets/backend/js/core.bundle.js',
    'public/assets/backend/vendors/ktui/ktui.min.js',
    'public/assets/backend/js/jquery-3.7.1.min.js',
    'public/assets/backend/js/sweetalert.js',
    'public/assets/backend/js/flatpickr.js',
], 'public/assets/backend/mix/js/app-core.js');

// DATATABLE
mix.scripts([
    'public/assets/backend/js/datatables/dataTables.min.js',
    'public/assets/backend/js/datatables/select.min.js',
    'public/assets/backend/js/datatables/buttons.min.js',
    'public/assets/backend/js/datatables/buttons.html5.min.js',
    'public/assets/backend/js/datatables/buttons.print.min.js',
    'public/assets/backend/js/datatables/jszip.min.js',
    // 'public/assets/backend/js/datatables/pdfmake.min.js',
    // 'public/assets/backend/js/datatables/vfs_fonts.js',
    'public/assets/backend/js/datatables/render-pagination.js',
], 'public/assets/backend/mix/js/exilednoname-dt-plugins.js');