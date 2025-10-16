# START
- Copy .env.example to .env
- [COMMAND] - composer install
- [COMMAND] - npm install
- [COMMAND] - php artisan storage:link
- [COMMAND] - php artisan migrate:refresh --seed
- [COMMAND] - php artisan serve

# OBFUSCATOR
npx javascript-obfuscator resources/assets/datatable-index.js --output public/assets/backend/mix/js/exilednoname-dt-index.js --compact true --control-flow-flattening true

# SAMPLE CRUD
php artisan crud:generate Posts --fields_from_file="./resources/cruds/sample.json"

php artisan crud:generate SuratMasuk --fields_from_file="./resources/cruds/sample.json" --controller-namespace="Mail" --model-namespace="Mail" --view-path="mail" --route-group="mail"

# TO DO
- PAGE AUTHENTICATION
    - [OK] LOGIN
    - FORGOT PASSWORD - CREATE AJAX VALIDATION
    - REGISTER - CREATE AJAX VALIDATION
    - SET NEW PASSWORD - CREATE AJAX VALIDATION REDIRECT DASHBOARD
    - VERIFY EMAIL - CREATE AJAX VALIDATION

- [OK] PAGE INDEX ->
    - [OK] ADMINISTRATIVE TOOLS (PAGE ACTIVITIES & TRASH)
    - [OK] SECTION WIDGET TOP & BOTTOM
    
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
- [OK] HEAD TITLE
- GENERATOR PAGES

- [OK] PAGE FILE MANAGER
- [OK] PAGE PROFILES
- [OK] LOGOUT EDIT TRANSLATE MODAL

- [OK] PAGE ACTIVITIES
- [OK] PAGE TRASH

- [OK] PAGE APPLICATIONS
- [OK] PAGE MANAGEMENTS
- [OK] PAGE DATABASE
- [OK] PAGE SESSIONS
