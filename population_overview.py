from settings import *

db = SQLAlchemy(app)

class PopulationRecord(db.Model):
	__tablename__ = 'population_overview'
	country = db.Column(db.String(40), primary_key=True, unique=True)
	population_value = db.Column(db.Integer, nullable=False)
	yearly_change = db.Column(db.Float, nullable=True)
	land_area = db.Column(db.Integer, nullable=True)
	migrants = db.Column(db.Integer, nullable=True)
	med_age = db.Column(db.Integer, nullable=True)

	def serialize(self):
		return {
			'countryOverview':{
				'country': self.country,
				'population_value': self.population_value,
				'yearly_change': self.yearly_change,
				'land_area': self.land_area,
				'migrants': self.migrants,
				'med_age': self.med_age
			}
		}

parser = reqparse.RequestParser(bundle_errors=True)
parser.add_argument('country', type=str, required=True, help="country is required parameter!")
parser.add_argument('population_value', type=int, required=True, help="population_value is required parameter!")
parser.add_argument('yearly_change', type=float, required=True, help="yearly_change is required parameter!")
parser.add_argument('land_area', type=int, required=True, help="land_area is required parameter!")
parser.add_argument('migrants', type=int, required=True, help="migrants is required parameter!")
parser.add_argument('med_age', type=int, required=True, help="med_age is required parameter!")

class PopulationList(Resource):
	def get(self):
		records = PopulationRecord.query.all()
		return [PopulationRecord.serialize(record) for record in records]

	def post(self):
		args = parser.parse_args()
		population_records = PopulationRecord(country=args['country'], population_value=args['population_value'],\
			 yearly_change=args['yearly_change'], land_area=args['land_area'], migrants=args['migrants'], med_age=args['med_age'])
		db.session.add(population_records)
		db.session.commit()
		return PopulationRecord.serialize(population_records), 201

class Population(Resource):
	def get(self, record_country):
		return PopulationRecord.serialize(PopulationRecord.query.filter_by(country = record_country).first_or_404(description='Record with country={} is not available'.format(record_country)))

	def delete(self, record_country):
		record = PopulationRecord.query.filter_by(country = record_country)\
		.first_or_404(description='Record with country={} is not available'.format(record_country))
		db.session.delete(record)
		db.session.commit()
		return '', 204
	
	def put(self, record_country):
		args = parser.parse_args()
		record = PopulationRecord.query.filter_by(country = record_country)\
            .first_or_404(description='Record with id={} is not available'.format(record_country))
		record.country = args['country']
		record.population_value = args['population_value']
		record.yearly_change = args['yearly_change']
		record.land_area = args['land_area']
		record.migrants = args['migrants']
		record.med_age = args['med_age']
		db.session.commit()
		return PopulationRecord.serialize(record), 201

