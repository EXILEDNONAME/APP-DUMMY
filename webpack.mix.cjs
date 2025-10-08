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

// mix.js('resources/js/app-core.js', 'public/assets/backend/mix/js')
//    .minify('public/assets/backend/mix/js/app-core.js')
//    .setPublicPath('public/assets/backend/mix/js');

// DATATABLE
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
    'public/assets/backend/js/datatables/buttons.min.js',
    'public/assets/backend/js/datatables/buttons.html5.min.js',
    'public/assets/backend/js/datatables/buttons.print.min.js',
    'public/assets/backend/js/datatables/select.min.js',
    'public/assets/backend/js/datatables/render-pagination.js',
], 'public/assets/backend/mix/js/exilednoname-dt-plugins.js');

// // APP JS
// mix.scripts([
//     'public/assets/backend/js/core.js',
//     'public/assets/backend/plugins/global/plugins.bundle.js',
//     'public/assets/backend/plugins/custom/prismjs/prismjs.bundle.js',
//     'public/assets/backend/js/scripts.bundle.js',
//     'public/assets/backend/js/pages/widgets.js',
//     'public/assets/backend/js/toast-options.js',
//     'public/assets/backend/js/logout.js',
// ], 'public/assets/backend/mix/js/app.js');

// // APP CSS
// mix.scripts([
//     'public/assets/backend/plugins/global/plugins.bundle.css',
//     'public/assets/backend/plugins/custom/prismjs/prismjs.bundle.css',
//     'public/assets/backend/css/style.bundle.css',
//     'public/assets/backend/css/themes/layout/header/base/light.css',
//     'public/assets/backend/css/themes/layout/header/menu/light.css',
//     'public/assets/backend/css/themes/layout/brand/dark.css',
//     'public/assets/backend/css/themes/layout/aside/dark.css',
//     'public/assets/backend/plugins/custom/datatables/datatables.bundle.css',
// ], 'public/assets/backend/mix/css/app.css');

// // DATATABLE BUNDLES
// mix.scripts([
//     'public/assets/backend/plugins/custom/datatables/datatables.bundle.js',
//     'public/assets/backend/js/datepicker.js',
// ], 'public/assets/backend/mix/js/datatable.js');

// // FILE-MANAGER CSS
// mix.scripts([
//     'public/assets/backend/elfinder/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css',
//     'public/assets/backend/elfinder/css/elfinder.full.css',
//     'public/assets/backend/elfinder/css/theme.css',
// ], 'public/assets/backend/mix/css/file-manager.css');

// // FILE-MANAGER JS
// mix.scripts([
//     'public/assets/backend/elfinder/ajax/libs/jquery/1.11.0/jquery.min.js',
//     'public/assets/backend/elfinder/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js',
//     'public/assets/backend/elfinder/js/elfinder.full.js',
// ], 'public/assets/backend/mix/js/file-manager.js');

