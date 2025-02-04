@servers(['web' => ['dhankumar@192.250.235.18']])

@task('deploy')
    cd /home/dhankumar/moverapp
    rm -rf *
    echo "Removed vendor/ directory"

    git pull origin main

    composer install --optimize-autoloader --no-dev

    php artisan app:reset

    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
@endtask

