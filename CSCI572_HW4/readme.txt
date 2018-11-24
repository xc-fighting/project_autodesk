name: Chen Xu
student ID:9012039827
for the implementation of this homework:I use wamp(apache+php+mysql in windows) for my server,then in my virtualbox's 
machine,I set up the ubuntu and install solr on it,so basically my ip of solr and my windows apache is different because I use
bridge mod to connect between my ubuntu and windows. so the $solr=new Apache_Solr_Service('192.168.0.31',8983,'/solr/csci572/');
my ip is not the localhost but the ip address of my ubuntu and the core I make is csci572 which is also the name of the core.
when you want to apply this:you need to put apache server and your solr into the same lan which means they should share same net gateway
and default mask.