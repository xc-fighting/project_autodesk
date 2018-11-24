import networkx as nx;
print("start processing-------");
G=nx.read_edgelist("edgeList.txt",create_using=nx.DiGraph());
pr=nx.pagerank(G,alpha=0.85,personalization=None,max_iter=30,
	tol=1e-06,nstart=None,weight='weight',dangling=None);
file=open("external_pageRankFile.txt","w");
for key in pr:
	file.write("/home/xuchen/Desktop/solr-7.1.0/crawl/USA/"+key+"="+str(pr[key]));
	file.write("\n");
file.close();
print("processing end---------");