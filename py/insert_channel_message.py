from init import *
import json

realinput = process_stdin()
json_input = json.loads(realinput)
print(db.channel_messages_data.insert(json_input))
