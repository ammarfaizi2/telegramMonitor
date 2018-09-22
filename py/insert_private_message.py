from init import *
import json

realinput = process_stdin()
json_input = json.loads(realinput)
db.crawling_target.insert(json)
