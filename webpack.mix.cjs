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