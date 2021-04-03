# Laravel
Do the following steps serially to run the project in your computer.

## Open Folder
1. Open the folder where you cloned it.


## Run Commands
1. "composer install"
2. "npm install
3. Jump to Create files and folder section
4. "php artisan key:gen"

## Create files and folders
1. Create a .env file 
2. Copy the following:
		
		
	    APP_NAME=Laravel
        APP_ENV=local
        APP_KEY=
        APP_DEBUG=true
        APP_URL=http://localhost
        
        LOG_CHANNEL=stack
        
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=
        DB_USERNAME=root
        DB_PASSWORD=
        
        BROADCAST_DRIVER=log
        CACHE_DRIVER=file
        QUEUE_CONNECTION=sync
        SESSION_DRIVER=file
        SESSION_LIFETIME=120
        
        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379
        
        MAIL_DRIVER=smtp
        MAIL_HOST=smtp.mail.ru
        MAIL_PORT=465
        MAIL_USERNAME=
        MAIL_PASSWORD=
        MAIL_ENCRYPTION=ssl
        MAIL_FROM_ADDRESS=
        MAIL_FROM_NAME=
        
        
        AWS_ACCESS_KEY_ID=
        AWS_SECRET_ACCESS_KEY=
        AWS_DEFAULT_REGION=us-east-1
        AWS_BUCKET=
        
        PUSHER_APP_ID=
        PUSHER_APP_KEY=
        PUSHER_APP_SECRET=
        PUSHER_APP_CLUSTER=mt1
        
        MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
        MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
        
3. Change the environment variable and Save. 		


