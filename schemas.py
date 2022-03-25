happinesSchema = {
	"$schema": "https://json-schema.org/draft/2019-09/schema",
  "title": "World Happiness",
  "description": "Information about world happiness/obesity/wages per country",
  "required": ["rank", "country", "score", "gdp", "social_support", "healthy_life_expectancy", "life_choices_freedom", "generosity", "corruption_perception"],
  "type": "object",
  "properties":{
      " rank":{
        "description": "rank of a country depends on happiness",
        "type": "integer",
        "minimum": 1
      },
      "country":{
        "description": "Name of country",
        "type": "string"
      },
      "score":{
        "description": "happiness score",
        "type": "number",
        "minimum": 0,
        "maximum": 10.0,
         "multipleOf": 0.01
      },
      "gdp":{
        "description": "gdp average",
        "type": "number",
        "minimum": 0,
        "maximum": 10.0,
         "multipleOf": 0.01
      },
      "social_support":{
        "description": "social support ",
        "type": "number",
        "minimum": 0,
        "maximum": 10.0,
         "multipleOf": 0.01
      },
      "healthy_life_expectancy":{
        "description": "healthy life expectancy from 0 to 1 ",
        "type": "number",
        "minimum": 0,
        "maximum": 1.0,
         "multipleOf": 0.01
      },
      "life_choices_freedom":{
        "description": "freedom to make life choices from 0 to 1 ",
        "type": "number",
        "minimum": 0,
        "maximum": 1.0,
         "multipleOf": 0.01
      },
      "generosity":{
        "description": "citizen's generosity ",
        "type": "number",
        "minimum": 0,
        "maximum": 1.0,
        "multipleOf": 0.01
      },
      "corruption_perception":{
        "description": "perception of corruption ",
        "type": "number",
        "minimum": 0,
        "maximum": 1.0,
        "multipleOf": 0.01
      }


  }
}