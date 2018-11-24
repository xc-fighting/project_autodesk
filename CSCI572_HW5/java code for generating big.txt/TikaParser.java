package homework5.tikaparse;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileWriter;
import java.io.InputStream;
import java.io.OutputStream;

import org.apache.tika.metadata.Metadata;
import org.apache.tika.parser.AutoDetectParser;
import org.apache.tika.sax.BodyContentHandler;

public class TikaParser {

	public static void main(String[] args){
		 BodyContentHandler handler=new BodyContentHandler(-1);
		
		 AutoDetectParser parser=new AutoDetectParser();
		 Metadata metadata=new Metadata();
		 try{
			 String dirpath="C:\\Users\\xuchen\\Desktop\\WebSpider\\tikaparse\\USA";
			 File dir=new File(dirpath);
			 int numberProcessed=0;
			 for(File file:dir.listFiles()){
				 FileInputStream is=new FileInputStream(file);
				 parser.parse(is, handler, metadata);
				 FileWriter fw=new FileWriter("big.txt");
				 BufferedWriter bw=new BufferedWriter(fw);
				 bw.write(handler.toString());
				 bw.flush();
				 bw.close();
				 fw.close();
				 is.close();
				 System.out.println("file "+numberProcessed+" processed");
				 numberProcessed++;
			 }
			 	 
		 }
		 catch(Exception e){
			 e.printStackTrace();
		 }
	}
}
