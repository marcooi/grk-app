- Clone Repository  
     `git clone https://github.com/marcooi/grk-app.git `

- change folder
    ` cd grk-app/ `

- Install Node Js for Vite ( Optional )

      # Download and install nvm:
      curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash
      # in lieu of restarting the shell
      \. "$HOME/.nvm/nvm.sh"
      # Download and install Node.js:
      nvm install 22
      # Verify the Node.js version:
      node -v # Should print "v22.16.0".
      nvm current # Should print "v22.16.0".
      # Verify npm version:
      npm -v # Should print "10.9.2".  


- Change this based on your preference

    == app:  ==
    image: istw-apps-img
    container_name: app_container
     networks:
      - app_network

    == NGINX: ==
    container_name: app_nginx
     ports:
      - 91:80
     networks:
      - app_network

    == horizon: ==
    image: istw-apps-img
    container_name: app_horizon
    networks:
      - app_network
    depends_on:
      - app
    
    == schedule-worker: ==
    image: istw-apps-img
    container_name: app_schedule_worker
    networks:
      - app_network

    networks:
        app_network:

- Build image
    ` docker compose build --no-cache `

- Set Permission 
    <!-- ` sudo chown -R 1000:1000 ./src ` -->

    ` sudo chown -R :www-data ./src `
    ` sudo chmod -R g+rw ./src `
    ` sudo chmod g+s ./src `
 

- cd src  
 
- copy .env.example to .env  
     ` cp .env.example .env`

- edit .env  
    `nano .env`  

   Edit value this section  


- move up one folder  
     `cd ..`  

- run docker compose  
     ` docker compose up -d `     

- masuk ke console container 
    ` docker compose exec app bash `


- install and run composer   
     ` composer install --optimize-autoloader --no-dev `  
     ` composer require fakerphp/faker --dev `

     ` php artisan migrate `
     ` php artisan key:generate `
     ` npm run build `
     ` composer dump-autoload `
     ` php artisan storage:link` 

     

