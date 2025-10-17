# START
- Copy .env.example to .env
- [COMMAND] - composer install
- [COMMAND] - npm install
- [COMMAND] - php artisan storage:link / Create Folder (public/storage/files)
- [COMMAND] - php artisan migrate:refresh --seed
- [COMMAND] - php artisan serve

# OBFUSCATOR
npx javascript-obfuscator resources/assets/datatable-index.js --output public/assets/backend/mix/js/exilednoname-dt-index.js --compact true --control-flow-flattening true

# SAMPLE CRUD
php artisan crud:generate Posts --fields_from_file="./resources/cruds/sample.json"

php artisan crud:generate SuratMasuk --fields_from_file="./resources/cruds/sample.json" --controller-namespace="Mail" --model-namespace="Mail" --view-path="mail" --route-group="mail"

# TO DO
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
    
- [OK] PAGE FILE MANAGER
- [OK] PAGE PROFILES
- [OK] PAGE APPLICATIONS
- [OK] PAGE MANAGEMENTS
- [OK] PAGE DATABASE
- [OK] PAGE SESSIONS

- [OK] GENERATOR PAGES
- [OK] PAGE AUTHENTICATION
    - [OK] LOGIN
    - [OK] FORGOT PASSWORD - CREATE AJAX VALIDATION
    - [OK] VERIFY EMAIL - CREATE AJAX VALIDATION
    - [OK] REGISTER - CREATE AJAX VALIDATION
    - [OK] SET NEW PASSWORD - CREATE AJAX VALIDATION REDIRECT DASHBOARD