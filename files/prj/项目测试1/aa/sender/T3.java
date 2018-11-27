package projectOne;

import java.io.PrintWriter;
import java.util.Scanner;
import java.io.File;
import java.io.IOException;

public class T3 {

	public static void main(String[] args) throws IOException
	{
		int count60=0, countFailed = 0, count80 = 0;
		Scanner inFile = new Scanner(new File("f:\\score.txt"));
		PrintWriter writer = new PrintWriter(new File("f:\\score_summary.txt"));
		int [] score = new int [120];
		int num = 0;
		int total = 0;
		double avg = 0;
		
		while(inFile.hasNextInt())
		{
			score[num]=inFile.nextInt();
			total+=score[num];
			
			if(score[num]<60) countFailed++;
			else if(score[num]<80) count60++;
			else count80++;
			
			num++;
		}
		avg = total/(double)num;
		
		System.out.println("Totally: "+num);
		writer.println("Totally: "+num);
		System.out.println("Failed: "+countFailed);
		writer.println("Failed: "+countFailed);
		System.out.println("60-79: "+count60);
		writer.println("60-79: "+count60);
		System.out.println("Above 80: "+count80);
		writer.println("Above 80: "+count80);
		System.out.println("Average Score: "+avg);
		writer.println("Average Score: "+avg);
		writer.close();
		inFile.close();	
			
	}

}
