echo "Copying the secret"
cp .env.example .env
echo "Installing your soul"
composer update
echo "Start generating your identity"
php artisan key:generate
echo "Put brain in your head"
php artisan migrate:fresh
echo "Put memories in your life"
php artisan db:seed
echo "Happy Coding!"
