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

jwt:
	set -e
	apk add openssl
	mkdir -p config/jwt
	jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')}
	echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
	echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
