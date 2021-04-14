dev: perm
	docker-compose up -d --build

dd:
	docker-compose down
du:
	docker-compose up

structure:
	if [ ! -d "../mysql-data" ]; then mkdir ../mysql-data; fi

perm: structure
	sudo chown -R $(USER):$(USER) ../mysql-data
