for the implementation of this homework:I use wamp(apache+php+mysql in windows) for my server,then in my virtualbox's 
machine,I set up the ubuntu and install solr on it,so basically my ip of solr and my windows apache is different because I use
bridge mod to connect between my ubuntu and windows. so the $solr=new Apache_Solr_Service('192.168.0.31',8983,'/solr/csci572/');
my ip is not the localhost but the ip address of my ubuntu and the core I make is csci572 which is also the name of the core.
when you want to apply this:you need to put apache server and your solr into the same lan which means they should share same net gateway
and default mask.
the netgraph.py is used to generate external_pageRankFile
where content of each line is:
/home/xuchen/Desktop/solr-7.1.0/crawl/USA/f3a65ee533913f14be962424ef9867edc88e6ca3df73b1356bbf8a4279bc599a.html=8.73021212193e-06
and this file is used for solr