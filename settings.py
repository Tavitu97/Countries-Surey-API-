from flask import Flask, request, Response, jsonify
from flask_sqlalchemy import SQLAlchemy
import json
from simplexml import dumps
from flask import Flask, make_response
from flask_restful import Api
from flask import Flask, jsonify
from flask_restful import Resource, Api, abort, reqparse
from flask_sqlalchemy import SQLAlchemy
app = Flask(__name__)
api = Api(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///country_overview.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS']=True
