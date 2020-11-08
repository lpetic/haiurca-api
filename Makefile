deploy:
	git push heroku HEAD:main
	heroku run make install

install:
	composer install
	make fixtures

fixtures:
	php bin/console doctrine:migrations:diff
	php bin/console doctrine:migrations:migrate
	php bin/console doctrine:fixtures:load

jwt:
	chmod -R 777 config/
	mkdir -p config/jwt
	jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')}
	echo "$jwt_passphrase" | openssl genrsa -out config/jwt/private.pem 4096
	echo "$jwt_passphrase" | openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
