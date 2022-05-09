from settings import *
from sqlalchemy import desc


	#db initialization
db = SQLAlchemy(app)

class HappinessRecord(db.Model):
	__tablename__ = 'happiness_overview'
	rank = db.Column(db.Integer,nullable = False, unique = True)
	country = db.Column(db.String(40), primary_key=True, unique=True)
	score = db.Column(db.FLOAT, nullable = False)
	gdp = db.Column(db.FLOAT, nullable = False)
	social_support = db.Column(db.FLOAT, nullable = False)
	healthy_life_expectancy = db.Column(db.FLOAT, nullable = False)
	life_choices_freedom = db.Column(db.FLOAT, nullable = False)
	generosity = db.Column(db.FLOAT, nullable = False)
	corruption_perception = db.Column(db.FLOAT, nullable = False)
	def serialize(self): 
		return { 
			'countryOverview':{
				'rank': self.rank, 
				'country': self.country,
				'score': self.score, 
				'gdp': self.gdp, 
				'social_support': self.social_support, 
				'healthy_life_expectancy': self.healthy_life_expectancy, 
				'life_choices_freedom': self.life_choices_freedom, 
				'generosity': self.generosity,
				'corruption_perception': self.corruption_perception
			}
		
		}
	

parser = reqparse.RequestParser(bundle_errors=True)
parser.add_argument('rank', type=int, required=True, help="rank is required parameter!")
parser.add_argument('country', type=str, required=True, help="country is required parameter!")
parser.add_argument('score', type=float, required=True, help="score is required parameter!")
parser.add_argument('gdp', type=float, required=True, help="gdp is required parameter!")
parser.add_argument('social_support', type=float, required=True, help="social_support is required parameter!")
parser.add_argument('healthy_life_expectancy', type=float, required=True, help="healthy_life_expectancy is required parameter!")
parser.add_argument('life_choices_freedom', type=float, required=True, help="life_choices_freedom is required parameter!")
parser.add_argument('generosity', type=float, required=True, help="generosity is required parameter!")
parser.add_argument('corruption_perception', type=float, required=True, help="corruption_perception is required parameter!")

class HappinessList(Resource):
	def get(self):
		records = HappinessRecord.query.all()
		return [HappinessRecord.serialize(record) for record in records]

	def post(self):
		args = parser.parse_args()
		happinessRecord = HappinessRecord(rank=args['rank'], country=args['country'],\
			 score=args['score'], gdp=args['land_gdparea'], social_support=args['social_support'], \
				 healthy_life_expectancy=args['healthy_life_expectancy'], life_choices_freedom=args['life_choices_freedom'],\
					 generosity=args['generosity'],corruption_perception=args['corruption_perception'])
		db.session.add(happinessRecord)
		db.session.commit()
		return HappinessRecord.serialize(happinessRecord), 201

class Happiness(Resource):
	def get(self, record_country):
		return HappinessRecord.serialize(HappinessRecord.query.filter_by(country = record_country).first_or_404(description='Record with country={} is not available'.format(record_country)))

	def delete(self, record_country):
		record = HappinessRecord.query.filter_by(country = record_country)\
		.first_or_404(description='Record with country={} is not available'.format(record_country))
		db.session.delete(record)
		db.session.commit()
		return '', 204
	
	def put(self, record_country):
		args = parser.parse_args()
		record = HappinessRecord.query.filter_by(country = record_country)\
            .first_or_404(description='Record with id={} is not available'.format(record_country))
		record.rank = args['rank']
		record.country = args['country']
		record.score = args['score']
		record.gdp = args['gdp']
		record.social_support = args['social_support']
		record.healthy_life_expectancy = args['healthy_life_expectancy']
		record.life_choices_freedom = args['life_choices_freedom']
		record.generosity = args['generosity']
		record.corruption_perception = args['corruption_perception']
		db.session.commit()
		return HappinessRecord.serialize(record), 201

