# ctm
CTM test


# Instructions

To start up the project all that is needed is to `docker-compose up` this would start up a web container with apache and mysql. 

The repo contains already a database dump with the initial datbaase. Since it's a database dump there is no need to run migrations, but 
if for some reason the databse where to be cleaned up, `php artisan migrate` would run and create the needed db tables.

This project assumes that there is a host entry `127.0.0.1       dev.ctmtest.com`

## Troubleshooting setup

- Ocasionally you might get an error saying httpd already running. Doing `docker-compose down` and then `docker-compose up` solves the problem.

- Since docker-compose has specified port 443 there is a chance that the port might be taken. In that case change the port and add it to the request url.

# Description

The repo contains only one Endpoint /api/v1/email_contact and there is only one required parameter: email. 

The following parameters are optiona:
- firstname (String) Default: null
- lastname (String) Default: null
- opt_in (If it contains 0 or empty it is assumed as opt out). Default: 0
 
In case that an upate needs to be made to opt out we only have to call the same endpoint with all the parameters and the same email. Basically 
if an email is found it would perform an update, if not it will creaate a record with that email.

Example to Opt In Contact:

`curl -ik -X POST -d "email=eromero@test.com&firstname=Enrique&lastname=Romero&opt_in=1"  https://dev.ctmtest.com/api/v1/email_contact`

Example to opt out contact:

`curl -ik -X POST -d "email=eromero@test.com&opt_in=0"  https://dev.ctmtest.com/api/v1/email_contact`

