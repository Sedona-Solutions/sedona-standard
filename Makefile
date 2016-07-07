define display_help
        @echo "       make -B install-dev               Install a fresh dev environment from sources"
        @echo "       make -B install-prod              Install a fresh prod environment from artefact"
        @echo "       make -B update-dev                Update an existing dev environment from sources"
        @echo "       make -B update-prod               Update an existing prod environment from artefact"
        @echo "       make -B build-artefact            Generate Artefact"
endef

help:
	$(display_help)

build-artefact:
	@./bin/deploy/build-artefact.sh

install-dev: install-global-dirs composer-install create-db
	@echo "Dev Installed"

update-dev: install-global-dirs composer-install migrate-db
	@echo "Dev Updated"

install-prod: install-global-dirs create-db publish-to-root-dir
	@echo "Prod Installed"

update-prod: install-global-dirs migrate-db publish-to-root-dir
	@echo "Prod Updated"

composer-install:
	@./bin/deploy/composer-install.sh

create-db:
	@./bin/deploy/create-db.sh

migrate-db:
	@./bin/deploy/migrate-db.sh

update-global-dirs:
	@./bin/deploy/update-global-dirs.sh

install-global-dirs:
	@./bin/deploy/install-global-dirs.sh

publish-to-root-dir:
	@./bin/deploy/publish-to-root-dir.sh

