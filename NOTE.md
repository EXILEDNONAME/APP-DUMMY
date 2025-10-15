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
- PAGE SESSIONS
    - DELETE SESSIONS, COLUMN IP ADDRESS, COLUMN REGION
    - CHECK LOCATION
- PAGE MANAGEMENT USERS REMOVE TABLE AVATAR
- PAGE AUTH
    - [OK] LOGIN
    - REGISTER

- PAGE INDEX ->
    - ADMINISTRATIVE TOOLS (PAGE ACTIVITIES & TRASH)
    - SECTION WIDGET TOP & BOTTOM
    
- BUTTON ACTIVITIES & TRASH FOR ADMINISTRATOR
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
- PAGE FILE MANAGER
- EXPORT PDF & PRINT WITH STYLE
- HEAD TITLE
- PAGE OPTIMIZATIONS

- [OK] PAGE PROFILES
- LOGOUT EDIT TRANSLATE MODAL

- [OK] PAGE ACTIVITIES
- [OK] PAGE TRASH

- [OK] PAGE APPLICATIONS
- [OK] PAGE MANAGEMENTS
- [OK] PAGE DATABASE
