# 191 Gigasavvy
191 Project code

## Contributors
Luke Raus
Daniel McInnis

## Installation
1. Set up Laravel with Homestead (tutorial here: https://youtu.be/NcIPANwBghU)
2. Run: `vagrant ssh` to enter virtual machine
3. cd to the Laravel directory (the one with app,boostrap,config... folders)
4. Run: `composer install` and then `composer update` to get php depenancies
5. Create .env file based on example.env and match it to your local computer (should have done in tutorial but check here too)
6. Run: `php artisan key::generate` to create your app Key
7. Inside your vagrant machine Run: `php artisan migrate:refresh --seed` to get your DB up and current

