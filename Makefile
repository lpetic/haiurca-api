deploy:
	git push heroku main
	heroku run make install

install:
	rm -rf var vendor
	rm config/bundles.php
	mv config/bundles2.php config/bundles.php
	composer install
	php bin/console doctrine:migrations:diff
	php bin/console doctrine:migrations:migrate
	php bin/console doctrine:fixtures:load
