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
- BUTTON ACTIVITIES & TRASH FOR ADMINISTRATOR
- PAGE ACTIVITIES
- PAGE TRASH
    - [OK] INDEX
    - SINGLE RESTORE
    - SINGLE DELETE
    - SELECTED RESTORE
    - SELECTED DELETE
- PAGE DATABASE
- PAGE PROFILES -> EDIT AVATAR
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
- PAGE FILE MANAGER

- PAGE INDEX ->
    - ADMINISTRATIVE TOOLS (PAGE ACTIVITIES & TRASH)
    - OBFUCASTOR JS
    - ACTIVITIES
    - FILTER DATERANGE
    - FILTER STATUS
    - [OK] CONFIRM DELETE
    - [OK] CONFIRM SELECTED ACTIVE
    - [OK] CONFIRM SELECTED INACTIVE
    - [OK] CONFIRM SELECTED DELETE
    - [OK] EXPORT FULL (COPY, CSV, EXCEL, PDF & PRINT)
- PAGE SHOW
    - REFRESH ACTIVITIES
    - CONFIRM DELETE
    - PRINT QR
- [OK] PAGE CREATE
- EXPORT PDF & PRINT WITH STYLE
- ADD DATERANGE 