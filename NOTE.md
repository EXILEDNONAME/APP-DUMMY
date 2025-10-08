# START
- Copy .env.example to .env
- [COMMAND] - composer install
- [COMMAND] - npm install
- [COMMAND] - php artisan storage:link
- [COMMAND] - php artisan migrate:refresh --seed
- [COMMAND] - php artisan serve

# OBFUSCATOR
npx javascript-obfuscator resources/assets/datatable-index.js --output public/assets/backend/mix/js/datatable-index.js --compact true --control-flow-flattening true

# SAMPLE CRUD
php artisan crud:generate Posts --fields_from_file="./resources/cruds/sample.json"

php artisan crud:generate SuratMasuk --fields_from_file="./resources/cruds/sample.json" --controller-namespace="Mail" --model-namespace="Mail" --view-path="mail" --route-group="mail"

# TO DO 
- STYLES FONT BOLD

# EDIT TEMPLATE
- PAGE PROFILES -> EDIT AVATAR
- PAGE SETTINGS -> EDIT LOGO DESKTOP/MOBILE
- PAGE FILE MANAGER
- PAGE INDEX ->
    - ADMINISTRATIVE TOOLS (PAGE ACTIVITIES & TRASH)
    - OBFUCASTOR JS
    - ACTIVITIES
- PAGE SHOW
    - REFRESH ACTIVITIES
- PAGE CREATE
- PAGE EDIT
- EXPORT PDF & PRINT WITH STYLE