import sys

sys.path.append('../')

from config.mongo import *
from pymongo import MongoClient
import json
client = MongoClient(HOST, PORT)
db = client[DB_NAME]

def process_stdin():
    realinput = ""
    for line in sys.stdin:
        realinput += line
    realinput = realinput.rstrip()
    return realinput
