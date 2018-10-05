require "http/server"

server = HTTP::Server.new([
  HTTP::ErrorHandler.new,
  HTTP::LogHandler.new,
]) do |context|
  # cmd = "sh"
  # args = [] of String
  # args << "-c" << "sleep 100 &"
  # Process.run(cmd, args)

  context.response.content_type = "application/json"

  case context.request.path
  when "/run"
    context.response.print "\"#{context.request}\""
  when "/kill"
    context.response.print "\"Kill daemon\""
  end
end

address = server.bind_tcp "0.0.0.0", 8080
puts "Listening on http://#{address}"
server.listen
