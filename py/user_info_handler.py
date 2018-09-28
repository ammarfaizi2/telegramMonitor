from init import *

import json

realinput = process_stdin()
json_input = json.loads(realinput)

user = db.users_info.find_one({"user_id": json_input["user_id"]})
if user == None:
	print(db.users_info.insert({
		"user_id": json_input["user_id"],
		"info": json_input["info"],
		"updated_at": None,
		"updated_at_unix": None
	}))
else:
	print(db.users_info.update({
		{
			"user_id": json_input["user_id"]
		},
		{
			"user_id": json_input["user_id"],
			"info": json_input["info"],
			"updated_at": json_input["date"],
			"updated_at_unix": json_input["unix_date"]
		},
		**{
			"upsert": True
		}
	}))
