from init import *
import json

realinput = process_stdin()
json_input = json.loads(realinput)

user = db.users.find_one({"user_id": json_input["user_id"]})
if user == None:
	db.users.insert({
		"user_id": json_input["user_id"],
		"msg_count": 1,
		"created_at": json_input["date"],
		"created_at_unix": json_input["unix_date"],
		"updated_at": None,
		"updated_at_unix": None
	})
else:
	db.users.update_one(
		{
			"_id": user["_id"]
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

print(db.private_messages_data.insert(json_input))
