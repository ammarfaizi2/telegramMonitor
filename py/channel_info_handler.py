from init import *

import json

realinput = process_stdin()
json_input = json.loads(realinput)

channel = db.channels_info.find_one({"channel_id": json_input["channel_id"]})
if channel == None:
	print(db.channels_info.insert({
		"channel_id": json_input["channel_id"],
		"info": json_input["info"],
		"updated_at": None,
		"updated_at_unix": None
	}))
else:
	db.channels_info.update(
		{
			"_id": channel["_id"]
		},
		{
			"channel_id": json_input["channel_id"],
			"info": json_input["info"],
			"updated_at": json_input["date"],
			"updated_at_unix": json_input["unix_date"]
		},
		**{
			"upsert": True
		}
	)
	print(str(channel["_id"]))
