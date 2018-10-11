from init import *

#realinput = process_stdin()
#json_input = json.loads(realinput)

result = []
pt = db.channel_messages_data.find(
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
);

for i in pt:
	i["_id"] = str(i["_id"])
	result.append(i)

print(json.dumps(result))
