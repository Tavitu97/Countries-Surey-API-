#from general_overview import GeneralRecord
from happiness_overview import *
from obesity_overview import *
from population_overview import *
from validator import *
from settings import *

from schemas import *
from flask import Flask, Response, Request, current_app, jsonify


@api.representation('text/xml') #application/xml header
def output_xml(data, code, headers=None):
	resp = make_response(dumps({'response' : data}), code) # parses data from db to xml with response as a root
	resp.headers.extend(headers or {})
	return resp

@api.representation('application/json')
def output_json(data, code, headers=None):
	resp = make_response(json.dumps({'response': data}), code) #parses data from db to JSON with response as a root 
	
	resp.headers.extend(headers or {})
	return resp

#obesity routes
api.add_resource(ObesityList, '/obesity',
                                      '/')
api.add_resource(Obesity, '/obesity/<record_country>')

#Population routes routes
api.add_resource(PopulationList, '/population',
                                      '/')
api.add_resource(Population, '/population/<record_country>')

#Happiness routes routes
api.add_resource(HappinessList, '/happiness',
                                      '/')
api.add_resource(Happiness, '/happiness/<record_country>')



#api.add_resource(GeneralRecord, '/general')


#test of join

#results = db.session.query(HappinessRecord, ObesityRecord, PopulationRecord).join(ObesityRecord, ObesityRecord.country == HappinessRecord.country).join(PopulationRecord, PopulationRecord.country == ObesityRecord.country).with_entities(HappinessRecord.country, HappinessRecord.rank, PopulationRecord.population_value, HappinessRecord.score, ObesityRecord.both_sexes).all()
#print(results) join of all necessary info from all the datasets

if __name__ == "__main__":
	app.run(port=5000, debug=True)

	