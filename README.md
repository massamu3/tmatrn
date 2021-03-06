## Available functionalities:

+ Login and logout, forget password  (Lock account in 5 minutes after 3 failed attempts).

+ Manage employees (Add, edit and delete).
+ Manage countries, cities, states (Add, edit and delete).
+ Manage users (Add, edit and delete).
+ Manage salary (Add, edit and delete).
+ Manage division (Add, edit and delete).
+ Manage departments (Add, edit and delete).
+ Make reports (export to Excel and PDF).
+ Search (with multiple combine fields).
+ Pagination
+ Validation
+ Responsive

## Guide Video
https://www.youtube.com/watch?v=Jbt5bEgv_QM
composer update
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan config:clear
## Hotfix Videos
https://www.youtube.com/watch?v=bDmmKOdgIeY
https://www.youtube.com/watch?v=cEdQvdYLuSg
## License
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
During Installation
Package phpoffice/phpexcel is abandoned, you should avoid using it. Use phpoffice/phpspreadsheet instead.

## About Training Program
The program to record and manage training routines

## Platform used
IT uses Laravel 5.5 and AdminLTE and Mysql Database

## Installation 
   Instruction has assumed the following  installation has been done
   - npm
   - composer
   - mysql database
   - php 7.0+
   
## Procedures for Laravel
	- Install laravel "composer create-project --prefer-dist laravel/laravel blog "5.5.*"
	- Setup database
	- php artisan migrate
	- php artisan make:auth

## Procedures for adminLTE
	- Download in https://adminlte.io
	- Follow the procedure https://adminlte.io/docs/2.4/installation
	--npm install admin-lte --save
	--npm install 
	--npm run dev // this will compile  package.json file in root directory

## Configure mix between adminLTE and Laravel
	- Open the source code in the downloaded adminLTE-2.4.3/starter.html
	- Create new file in resources\views\layouts\master.blade.php and paste source code above
	- include js and css in master.html <script  src="{{asset('js/app.js')}}"></script>; <link rel="stylesheet" href="{{asset('css/app.css')}}">
	- point the application to start master.php as default, change the file resources\views\home.blade.php change @extends('layouts.master') from @extends('layouts.app') 
	-Import adminlte CSS: Open the file \resources\assets\sass\app.scss replace the bottom line import Adminlte CSS files @import "~admin-lte/dist/css/AdminLTE.css"; and  @import "~admin-lte/dist/css/skins/_all-skins.css"; 
	- Save and compile it by npm run watch 
	- From here an error occur (Error number 1)

## What I did (To correct error number 1)
	- Open public folder
	- Bower install admin-lte
	- Then nikaenda add css na js kwenye master.blade.php
	- Madesa ya css nimechukua kwenye bower_install/admin-lte/index.html
	- Go to the file 

## Installation iliendelea kwa kufanya yaguatayo:-
	- Databases zilishaandaliwa tangu mwanzo. 
	- Baada ya hapo run php artisan make:controller RegistersController //controller Created at http\controller (Registers ni mfano wa database, database zote zinazohitajika zilitengenezwa)
	- Create a model php artisan make:model Registers -m // Model shttp\Providers\* 
	- Fungua migration file in databases\migrations and update fields accordingly
	- Run php artisan make:migrate create tables from migrations  
	
## CRUD Step by step
 
	- The command php artisan make:model Registers –m will create model class as well as migration file 
	- php artisan migrate:fresh  creates a table from all migrations
	- Create a folder registers and index.blade.php in it.; index must  extend master file in resourses\views\
	- In  master.blade.php file and add  <a href="{{url('registers')}}">Registration </a>
	- Make controler with basic info php artisan make:controller RegistersController -r
	- Update route\web.php file will start welcome ? home. Note home extend master dd Route::resource('registers', 'RegistersController');
	- Tell the controler to list views: open the file /http/RegistersController.php add return view (registers.index’);
	- Make content environment in resourses\views\registers\index.php add  @section('content')
	- Tell master.php file to display the content from the file in step 8
	- Modal clas and button: cop the scripts from https://getbootstrap.com/docs/3.3/javascript and put in Registers\index.php file. File has been edited accordinly
	- Go to the model /http/RegistersController.php add method creat in the function store and impor the class
	- Go to model in Provider\Registers.php update as shown
	- To display the data: create table as in views\registers\index.php
	- Modify the controller to contain variable for displaying
	- An error from update the record

## Update issue -, 
--> Kwenye registers_id kua null, nimeongezea id="reg_id" kwenye input field, kwenye java script zako ulikua uneffect field yenye hiyo id
--> Kwenye Registers Controller, changes iko mstari wa 81 


## Database table descriptions

see migrations

## CRUD Procedure:

- Create Model and Migration at the same time: php artisan make:model Program -m 
- Class named Program and migrations/table programs created automatic automatic
- Customise the fields migrations: based on Database table descriptions above
- Migrate the table php artisan migrate:fresh //will overite if exists
- Create a new folder program in view director
- create index.blade.php in it that will extend the master page
- Change link and lablel in the master page relate to the program created above
- Make a control php artisan make:controller ProgramController -r //with resources
- Now create a route: in route\web.php //Will reference category controller
- If you want to list all available routes:  php artisan route:list
- Once you click a link on the master page, it will go to program in which it has a Controller  ProgramController in the program controller it will go to the public function index()
- Instruct the index function to return the view: return ('program.index'); //rwill not be used
- create a section, table and contents in program/ndex.blade.php
- Go to bootstap.com /Javascript and take model window scripts change all in index.blade.php
- specify place in master.php to yeald the contents:   @yield('content') section
- Open the model and make it to fill the table: 
- Open the Controller and customise appropriate functions
- Js file in the master.php and corresponding js file in adminlte // bado from here


## AJAX search-Pagination-Datatable

## Link table and dydnamic combo
- Dynamic Dynamic Dropdown List 
-- Create a model and associated information: provider\ModelName.php
-- Create a provider named DynamicDropdownList.php in the provider directory
-- Import model name, array as shown in the file
-- Register provider:add App\Providers\DynamicDropdownList::class, in config/app.php
-- Use Array which we created in provider Open the form and specify as shown 



## Import Records

## Export

## Rules
 - Akifika miaka 3 kustaafu hastahili kwenda shule
 - Akifeli anakaa miaka 5 ndio asomeshwe tena
 - Akisha someshwa anatakiwa akae miaka 3 ndio asomeshwe tena ngazi ya juu zaidi
 - Akishasomweshwa na kumaliza anatakiwa afanye kazi miaka 3 bila kuhama
 - History ya kila mtu inatakiwa ionekane ata kama amekufa, kuhama au kustaafu

## Reports
 - Derived form birthdate

## Graphical interpretation
  - Wanawake vs wanaume
  - Programs
  - Divisions
  - Sections
  - Academic Level
  - Training trend in 5 to come

## Access Level 

## Wrup-up 

## Common errors

   - QLSTATE[HY000]: General error: 1364 Field 'xx' doesn't have a default value (SQL: insert into `programs`  - ensure all fiels exists in the MVCDM and field are not reserved word

   -  "SQLSTATE[HY000]: General error: 1364 Field 'xx' doesn't have a default value  - edit migration -> nullable() for string is not accepted 

   -  "Trying to get property of non-object (View: C:\wamp\www\trn\resources\views\layouts\master.blade.php) (View: C:\wamp\www\trn\resources\views\layouts\master.blade.php) ?" - No login name in the database

    - "Undefined variable: request"   imesisitizwa kwenye function destroy

Invalid argument supplied for foreach() (View: C:\wamp\www\tmatrn\resources\views\transactions-mgmt\create.blade.php) form properties invalid

Trying to get property of non-object (View: C:\wamp\www\tmatrn\resources\views\transactions-mgmt\index.blade.php)
in 2441cde5c117d776374649c73c13cc8d6f6bdf60.php line 61 // Angalia model--Mode iwe na id's za pande zote mbili

Trying to get property of non-object (View: C:\wamp\www\tmatrn\resources\views\transactions-mgmt\index.blade.php)
in 2441cde5c117d776374649c73c13cc8d6f6bdf60.php line 61 : Record kwenye data base haipo au haidani na ya kwenyenye foreign key table


System Customisations
http://localhost:8000/employee-management/create
Hints:
Country station
state division
city section



On Progress
Retired
Deseased
On Service
Dissmisal


To load in the controller use modify employee create function change to  $sections = Section::pluck('name','id'); pia andaliw index ya form iweze kutoa majina badala ya id

in the form create, pale inapotarrajiwa kuweka data, ongeza line   {!! Form::select('somename', null, [$sections], ['class'=>'form-control js-sections']) !!} 
Ili form iweze kufanya kazi lazima yafuatayuo yafanyike. Kwa vile natumia laravel 5.4

 composer require "laravelcollective/html":"^5.4.0"
 Next, add your new provider to the providers array of config/app.php
 Finally, add two class aliases to the aliases array of config/app.php:

  'aliases' => [
    // ...
      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,


## Next quickly
  	- Add through imployee,
  	- Seach all,
  	- Modify all forms
  	- Display
  	- Access Level - user to upload progressive report
  	- Report fillter in all table;
  	- custome report
  	- Attach certificate, Admin shall view all
  	- Notifications for the incoming certificate
  	- Auto display javascript - separate consept
 
 Rules
 - Akifika miaka 3 kustaafu hastahili kwenda shule
 - Akifeli anakaa miaka 5 ndio asomeshwe tena
 - Akisha someshwa anatakiwa akae miaka 3 ndio asomeshwe tena ngazi ya juu zaidi
 - Akishasomweshwa na kumaliza anatakiwa afanye kazi miaka 3 bila kuhama
 - History ya kila mtu inatakiwa ionekane ata kama amekufa, kuhama au kustaafu

## Reports
 - Derived form birthdate

## Graphical interpretation (Lara charts)
  - Wanawake vs wanaume
  - Programs
  - Divisions
  - Sections
  - Academic Level
  - Training trend in 5 to come
  
staus: on job training
Remarks on time frame + why not trainned?

Data migration
My favourite for the job is Windows based HeidiSQL. It gives you a graphical interface to build the LOAD DATA command; you can re-use it programmatically later

Running application without php artiasan serve
The need to point public  directory: 
procedure:
-- Edit the file apache/conf/extra/httpd-hots.conf
-- Create a virtual host by dublicate codes and create virtual hosts

-- Give permission to the storage directory chmod -R 777 storage/
Create a virtual host
-- in linux ubuntu: /etc/apache2/site-availables then add virtual hosts
-- Dublicate the file with running host kwenye folder la available virtual hosts
-- Activate visual hosts (Enable site on local machine) sudo a2ensite tmatrn.meteo.go.tz.tmatrn.conf
service apache2 reload
service apache2 restart gedi /etc/hosts


Create user, import database, update .env file, delete old project, zip local, change local database name, ensure correct paths, make changes on public index.php as well as .htcacces file
