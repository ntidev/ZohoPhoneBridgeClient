.PHONY: default test help deploy-repo

default: help

# COLORS
GREEN  := $(shell tput -Txterm setaf 2)
YELLOW := $(shell tput -Txterm setaf 3)
WHITE  := $(shell tput -Txterm setaf 7)
RESET  := $(shell tput -Txterm sgr0)

PROJECT_NAME = "zoho-phonebridge-client"
VERSION=dev-master

TARGET_MAX_CHAR_NUM=20
# Show this help.
help:
	@echo ''
	@echo '${YELLOW}${PROJECT_NAME}:${GREEN} is a client api to communicate with Zoho CRM PhoneBridge ${RESET}'
	@echo ''
	@echo 'Usage:'
	@echo '  ${YELLOW}make${RESET} ${GREEN}<target>${RESET}'
	@echo ''
	@echo 'Targets:'
	@awk '/^[a-zA-Z\-\_0-9]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")-1); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "  ${YELLOW}%-$(TARGET_MAX_CHAR_NUM)s${RESET} ${GREEN}%s${RESET}\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

## Test this library with PHPUnit
test:
	./vendor/bin/phpunit

## Install dependencies
install-dependencies:
	composer install

## Update dependencies
update-dependencies:
	composer update

## Deploy to NTI Composer Repo
deploy-repo:
	@echo 
	@echo '1- Creating ${YELLOW}${PROJECT_NAME}.zip${RESET}'
	@zip -r ${PROJECT_NAME}.zip composer.* phpunit.xml.dist src/
	@echo '2- Uploading to NTI Composer Repo VERSION=${VERSION} to ${NTI_REPOSITORY_COMPOSER}'
	@curl -v --user '${NTI_REPOSITORY_USER}:${NTI_REPOSITORY_PASSWORD}' --upload-file  ${PROJECT_NAME}.zip ${NTI_REPOSITORY_COMPOSER}/packages/upload/nti/${PROJECT_NAME}/${VERSION}
	@echo '3- Removing files...'
	@rm -rf ${PROJECT_NAME}.zip
	@echo 'Done!!'
