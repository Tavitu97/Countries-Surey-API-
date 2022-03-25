from lxml import etree
from settings import *

def validate(xml_path: str, xsd_path: str) -> bool:

    xmlschema_doc = etree.parse(xsd_path)
    xmlschema = etree.XMLSchema(xmlschema_doc)

    xml_doc = etree.XML(xml_path)
    result = xmlschema.validate(xml_doc)

    return result