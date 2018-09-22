from init import *

import json

realinput = process_stdin()
json_input = json.loads(realinput)

channel = db.channels.find_one({"channel_id": json_input["channel_id"]})
if channel == None:
	db.channels.insert({
		"channel_id": json_input["channel_id"],
		"msg_count": 1,
		"created_at": json_input["date"],
		"created_at_unix": json_input["unix_date"],
		"updated_at": None,
		"updated_at_unix": None
	})
else:
	db.channels.update_one(
		{
			"_id": channel["_id"]
		},
		{
			"$inc": { 
				"msg_count": 1
			},
			"$set": {
				"updated_at": json_input["date"],
				"updated_at_unix": json_input["unix_date"]
			}
		}
	)

print(db.channel_messages_data.insert(json_input))
