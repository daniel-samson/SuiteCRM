#!/bin/bash
export DATABASE_DRIVER=MYSQL
export DATABASE_NAME=automated_tests
export DATABASE_HOST=localhost
export DATABASE_USER=automated_tests
export DATABASE_PASSWORD=automated_tests
export INSTANCE_URL=http://path/to/instance
export INSTANCE_ADMIN_USER=admin
export INSTANCE_ADMIN_PASSWORD=admin
export INSTANCE_CLIENT_ID=suitecrm_client
export INSTANCE_CLIENT_SECRET=secret
./vendor/bin/codecept $@
