from flask_restful import Resource
from settings import *

db = SQLAlchemy(app)

class ObesityRecord(db.Model):
	__tablename__ = 'obesity_overview'
	country = db.Column(db.String(40), primary_key=True, unique=True)
	both_sexes = db.Column(db.FLOAT, nullable = False)
	male = db.Column(db.FLOAT, nullable = False)
	female = db.Column(db.FLOAT, nullable = False)

	def serialize(self): #function to convert the output to json
			return { 
				'countryOverview':{
					'country': self.country,
					'both_sexes': self.both_sexes, 
					'male': self.male, 
					'female': self.female
				}
			}

parser = reqparse.RequestParser(bundle_errors=True)
parser.add_argument('country', type=str, required=True, help="country is required parameter!")
parser.add_argument('both_sexes', type=float, required=True, help="both_sexes is required parameter!")
parser.add_argument('male', type=float, required=True, help="male is required parameter!")
parser.add_argument('female', type=float, required=True, help="female is required parameter!")

class ObesityList(Resource):
	def get(self):
		records = ObesityRecord.query.all()
		return [ObesityRecord.serialize(record) for record in records]

	def post(self):
		args = parser.parse_args()
		obesity_records = ObesityRecord(country=args['country'], both_sexes=args['both_sexes'], male=args['male'], female=args['female'])
		db.session.add(obesity_records)
		db.session.commit()
		return ObesityRecord.serialize(obesity_records), 201

class Obesity(Resource):
	def get(self, record_country):
		return ObesityRecord.serialize(ObesityRecord.query.filter_by(country = record_country).first_or_404(description='Record with country={} is not available'.format(record_country)))

	def delete(self, record_country):
		record = ObesityRecord.query.filter_by(country = record_country)\
		.first_or_404(description='Record with country={} is not available'.format(record_country))
		db.session.delete(record)
		db.session.commit()
		return '', 204
	
	def put(self, record_country):
		args = parser.parse_args()
		record = ObesityRecord.query.filter_by(country = record_country)\
            .first_or_404(description='Record with id={} is not available'.format(record_country))
		record.country = args['country']
		record.both_sexes = args['both_sexes']
		record.male = args['male']
		record.female = args['female']
		db.session.commit()
		return ObesityRecord.serialize(record), 201
