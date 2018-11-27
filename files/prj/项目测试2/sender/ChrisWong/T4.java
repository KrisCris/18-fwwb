package projectOne;

import java.io.File;
import java.util.Scanner;
import java.io.IOException;


public class T4 {

	public static void main(String[] args) throws IOException
	{
		String stringAmazing;
		Scanner inFile = new Scanner(new File("f:\\amazing.txt"));
		stringAmazing = inFile.nextLine();
//task 1	
		System.out.println(stringAmazing);		
		System.out.println("Length: "+stringAmazing.length());
//task 2		
		System.out.println(stringAmazing.charAt(5)+" "+stringAmazing.charAt(2)+" "+stringAmazing.charAt(0));		
//task 3		
		int index = 0;		
		if((index = stringAmazing.toUpperCase().indexOf("AMAZING"))!=-1)
		{
			System.out.println(index);
		}
//task 4
		String [] eachWords = stringAmazing.split(" ");		
		for(String word: eachWords)
		{
			System.out.printf("%s ", word);
		}
		System.out.println("");
//task 5		
		StringBuilder builder = new StringBuilder();		
		for(String word: eachWords)
		{
			builder.append("~"+word);
		}
		System.out.println(builder.toString());
		
		inFile.close();
		
	}

}
