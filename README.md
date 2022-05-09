# Countries overview API:

Octavian Dragu  -  Data Processing  -  25.03.2022

# Overview: 

With this API, data from different countries around the world about obesity, happiness and population is retrieved and sent to the users of the API. The data sets were provided from Kaggle, so the accuracy of the data is assumed to be correct. 

# Requirements:

The API was build in Python-Flask.

Install Python on your machine, and afterwards open a shell in the API folder and type “ pip install -r requirements.txt ” and press Enter.
In the requiremnts.txt file, are all of the required packages which are used to build and run the API.

The required modules:

aniso8601==8.1.0
astroid==2.4.2
attrs==20.3.0
certifi==2020.12.5
chardet==4.0.0
click==7.1.2
colorama==0.4.4
dicttoxml==1.7.4
elementpath==2.1.1
Flask==1.1.2
flask-expects-json==1.5.0
flask-jsonschema-validator==0.0.4
flask-marshmallow==0.14.0
Flask-RESTful==0.3.8
Flask-SQLAlchemy==2.4.4
idna==2.10
isort==5.7.0
itsdangerous==1.1.0
Jinja2==2.11.2
json2xml==3.6.0
jsonschema==3.2.0
lazy-object-proxy==1.4.3
lxml==4.6.3
MarkupSafe==1.1.1
marshmallow==3.10.0
marshmallow-sqlalchemy==0.24.1
mccabe==0.6.1
pylint==2.6.0
pylint-flask==0.6
pylint-flask-sqlalchemy==0.2.0
pylint-plugin-utils==0.6
pyrsistent==0.17.3
python-simplexml==0.1.5
pytz==2020.5
requests==2.25.1
six==1.15.0
SQLAlchemy==1.3.22
toml==0.10.2
urllib3==1.26.2
virtualenv==16.7.9
Werkzeug==1.0.1
wrapt==1.12.1
xmlschema==1.4.1
xmltodict==0.11.0

# DataBase

sqlite was used for this project. To view the db file, sqlite will need to be installed on your machine. 

# Virtual Environment 

    Virtual environments are independent groups of Python libraries, one for each project. Packages installed for one project will not affect other projects or the operating system’s packages.
    To create a virtual environment, follow the next steps:
    1.	Navigate to the project location:
    Open the cmd and navigate via cd command to the directory where the API is located. 
    In this specific case:
    cd D:\Github\Countries-Survey-API-
    2.	Create an environment 
    In the cmd, insert the following command:
    py -3 -m venv venv
    Your cmd will change to show the name of the activated environment

    3.	Activate the environment 
    In the cmd insert the next command:
    venv\Scripts\activate

    4.	Install the requirements
    In the cmd insert the next command:
    venv\Scripts\activate

    5.	Install the requirements
    To install all the modules required for this API, activate the environment in the API folder and run the following command in the cmd:
                 pip install -r requirements.txt .

# Run the API 

Open the API folder, and open a shell and type "python api.py" and press enter

# Routes 

127.0.0.1:5000/happiness – World Happiness

127.0.0.1:5000/obesity – World Obesity

127.0.0.1:5000/population – world Population

The data comes in different types depending on headers: application/json, text/xml

# Consumer

The consumer was build using PHP and JS. The reason behind this was to expand the knowledge and skills with scripting programming languages in reading and work with data which is available in JSON /XML format. 
To run the consumer, Xampp will need to be installed on your machine. After the installation just move the apiConsumer folder into Xampp folder, in htdocs folder.
To open the consumer, start xampp control panel and start the Apache and MySql.
After xampp modules are up and running, open a browser and typle in the search bar:
http://localhost:8080/apiConsumer/ 
In this case, I used port 8080. If you would like to change it, press the config button for the Apache module and change it. 


# For more information please check the UsageDocumentation.docx 