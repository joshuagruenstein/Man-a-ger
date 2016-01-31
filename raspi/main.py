import pymysql.cursors
import requests
import base64
import hashlib
import hmac
import json

def make_auth_token(upc_string, auth_key):
	sha_hash = hmac.new(auth_key, upc_string, hashlib.sha1)
	return base64.b64encode(sha_hash.digest())

def storeProductInfo(upcCode):
	r = requests.get("https://www.digit-eyes.com/gtin/v2_0/", params={'upcCode': upcCode, 'field_names': 'all', 'language': 'en', 'app_key': '/7917Xl9IRJS', 'signature': make_auth_token(upcCode.encode('utf-8'), "Gc08V4m0s2Ru4Gy1".encode('utf-8')).decode("utf-8")})
	jsonObject = r.json()
	print(jsonObject)
	r2 = requests.post("http://162.243.36.95/php/product", data={"productID": upcCode, "ingredients": jsonObject['ingredients'], "nutrition": jsonObject['nutrition'], "usage": jsonObject['usage'], "brand": jsonObject['brand'], "description": jsonObject['description']})
	print(r2.text)
storeProductInfo("0041143020104")