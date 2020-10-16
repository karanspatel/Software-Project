# Workspace Setup

The plan for developing this application is to do all of the work on local computers, we will **not** be utilizing cloud services. There is a possibility of implementing them in the future towards the end of the project, but it was recommended to work on this project locally to avoid issues with digital communications. 

## What you need
* A web browser (preferably Chrome for consistencies sake)
* A text editor (VS Code, Atom, Brackets, etc.)
* A terminal/command prompt
* XAMPP 
* A local copy of the project

## Running the website
As of right now, the idea is to keep everything local and just push updates to Github for everyone to access. We are NOT using a cloud server at the moment (though we are using a local HTTP server) to access the site so all you need to do is:

1. Get a local copy of the files from Github
2. Open the directory in whatever editor you are using
3. Make sure your XAMPP is running
4. Go to the local address where you have Apache running

**Sidenote:** I don't know if JavaScript code will work properly in Firefox or any other browser that isn't Chrome. Yes it is supported in all modern browsers, but Chromes V8 engine supposibly allows for more features than its competition, so Chrome should really be the browser you use for the development process. I am not sure if the engine will make any difference to what we are doing, but again use Chrome for consistency.

## Database: MySQL
Everyone will have a local database running on their computer. MySQL should be installed with XAMPP so there's no need to download it seperately. If we decide to utilize cloud services in the future, we can deploy a MySQL server cluster and work on getting communications working with it. 


#### Download and Setup

1. You can download the XAMPP installer [here](https://www.apachefriends.org/index.html). After you install it, turn on Apache and MySQL in the XAMPP application. 
2. Once XAMPP is running, you need to put all of the files in the project directory into the folder ```htdocs``` (which can be found in the xampp/lampp folder). If it has not already been done, create a folder called scripts and put all of the PHP and JavaScript files into it.
3. If you do not have the database for GhostPost already created, you will need to create it.   
**Note:** If you already had MySQL installed outsite of XAMPP with the GhostPost database already properly set up, then there's nothing you need to do.  
There are a few ways to do this but for simplicities sake: Navigate to ```localhost:8080``` and then to the database section. From here, you can create a database. Be sure to name it GhostPost. You'll need to create a table and insert the specifications of it. Just use the ```GhostPost_Schema.sql``` file as reference for creating the table and inserting the tuples. **Pro tip:** Run an SQL query using the contents of ```GhostPost_Schema.sql``` to insert the tuples. It'll be much easier.  
4. The website should now be running properly on ```localhost:8080/IndexFinal.html```. 


#### Connecting the database to the Website

This should happen automatically when you open the website. In the event of an ```Client does not support authentication protocol.....``` message, open a MySQL shell and run this code: ```ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';``` where you replace ```root``` with your username and ```password``` with your password.
