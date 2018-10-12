from init import *

realinput = process_stdin()
json_input = json.loads(realinput)

result = []
print(db.channel_messages_data.find(
	{
		"$and": [
			{
				"unix_date": {
					"$lte": json_input["end_date"]
				}
			},
			{
				"unix_date": {
					"$gte": json_input["start_date"]
				}
			}
		]
	}
).count());
