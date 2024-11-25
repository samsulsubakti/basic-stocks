php artisan migrate --force
php artisan migrate --path=microservices/Dolphin/src/Database//Migrations/ --force
php artisan migrate --path=microservices/Sailfish/src/Database//Migrations/ --force
php artisan migrate --path=database/migrations/Base/ --force
php artisan migrate --path=database/migrations/Budget/ --force
php artisan migrate --path=database/migrations/Master/ --force
php artisan migrate --path=database/migrations/Moderation/ --force
php artisan migrate --path=database/migrations/Task/ --force
php artisan migrate --path=database/migrations/Travel/ --force
php artisan migrate --path=database/migrations/Trip/ --force
php artisan migrate --path=database/migrations/NAMC/ --force
php artisan migrate --path=database/migrations/TableRefs/ --force

