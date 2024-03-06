# Deployment Instruction

## Deployment steps

1. Put the folder in an environment with **docker**

2. Change the permission of the folder by using `sudo chmod -R 777 final` where final is the folder name to avoid potential permission error.

3. Go to `final/src/myapp/application/config/config.php` and change `$config['base_url'] = 'http://your external IP address:8080/myapp/';`

4. Go back to the root `final/` and use `sudo docker-compose up -d`
   to deploy the project.

**Note**: To view the website, the address needs to be `http://your external IP address:8080/myapp/index.php`
