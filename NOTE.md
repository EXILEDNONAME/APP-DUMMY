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
- EDIT TOOLTIP
- [OK] MOVE MIX TO RESOURCE ASSETS & OBFUSCATOR
- [OK] PAGE TRASH
    - [OK] INDEX
    - [OK] SINGLE RESTORE
    - [OK] SINGLE DELETE PERMANENT
    - [OK] SELECTED RESTORE
    - [OK] SELECTED DELETE
    - [OK] FILTER DELETED_AT

- [OK] PAGE SHOW
    - [OK] CONFIRM DELETE
    - [OK] PRINT QR

- PAGE INDEX ->
    - [OK] ACTIVITIES
    - [OK] DATERANGE
    - [OK] FILTER STATUS
    - [OK] CONFIRM DELETE
    - [OK] CONFIRM SELECTED ACTIVE
    - [OK] CONFIRM SELECTED INACTIVE
    - [OK] CONFIRM SELECTED DELETE
    - [OK] EXPORT FULL (COPY, CSV, EXCEL, PDF & PRINT)
    - [OK] CHART COLOR
    - ADMINISTRATIVE TOOLS (PAGE ACTIVITIES & TRASH)
    - SECTION WIDGET TOP & BOTTOM
    
- BUTTON ACTIVITIES & TRASH FOR ADMINISTRATOR
- PAGE ACTIVITIES
- PAGE DATABASE
- PAGE PROFILES -> EDIT AVATAR
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
- PAGE FILE MANAGER
- [OK] PAGE CREATE
- EXPORT PDF & PRINT WITH STYLE