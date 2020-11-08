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

jwt2:
	chmod -R 777 config/
	mkdir -p config/jwt
	jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')}
	echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
	echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout

jwt2:
	chmod -R 777 config/
	mkdir -p config/jwt
	openssl genrsa -out config/jwt/private.pem 4096
	openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
