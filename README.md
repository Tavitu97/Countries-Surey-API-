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


# Run the API 

Open the API folder, and open a shell and type "python api.py" and press enter

# Routes 

127.0.0.1:5000/happiness – World Happiness

127.0.0.1:5000/obesity – World Obesity

127.0.0.1:5000/population – world Population

The data comes in different types depending on headers: application/json, text/xml

# Consumer

The consumer was build using PHP and JS. PHP to read the incomming data, and JS for the visualization part. 

To run the consumer, just put the apiConsumer folder in Xampp and run it.