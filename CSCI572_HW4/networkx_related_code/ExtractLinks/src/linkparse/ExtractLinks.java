package linkparse;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class ExtractLinks {
	
	Map<String,String> file_url=new HashMap<String,String>();
	Map<String,String> url_file=new HashMap<String,String>();
	Set<String> edges=new HashSet<String>();
	
	public void presolve() throws IOException{
		FileReader reader = new FileReader("USA Today Map.csv");
		BufferedReader br=new BufferedReader(reader);
		String str=null;
		while((str=br.readLine())!=null) {
			String[] group=str.split(",");
			file_url.put(group[0], group[1]);
			url_file.put(group[1], group[0]);
		}
		System.out.println(file_url.size());
		br.close();
		reader.close();
	}
	
	public void extract() throws IOException{
		String dirpath="C:\\Users\\xuchen\\Desktop\\CRAWL\\USA Today";
		File dir=new File(dirpath);
		for(File file:dir.listFiles()) {
			Document doc=Jsoup.parse(file,"UTF-8",file_url.get(file.getName()));
			Elements links=doc.select("a[href]");
			for(Element link:links) {
				String url=link.attr("abs:href").trim();
				if(url_file.containsKey(url)) {
					edges.add(file.getName()+" "+url_file.get(url));
					System.out.println(file.getName()+" "+url_file.get(url));
				}
			}
		}
		BufferedWriter bw=null;
		FileWriter fw = null;
		fw=new FileWriter("edgeList.txt");
		bw=new BufferedWriter(fw);
		for(String cur:edges) {
			bw.write(cur);
			bw.write("\n");
		}
		bw.close();
		fw.close();
	}
	
	public static void main(String[] args) {
		ExtractLinks solution=new ExtractLinks();
		try {
			solution.presolve();
			solution.extract();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}

}
