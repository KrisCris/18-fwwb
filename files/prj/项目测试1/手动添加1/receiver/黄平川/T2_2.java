package projectOne;

import java.util.Scanner;

public class T2_2 {

	public static void main(String[] args) {
//		long start=System.currentTimeMillis();
		//开始计时
		Scanner in = new Scanner(System.in);
		int fixedRole = 6, fixedColumn = 8;
		fixedRole = in.nextInt();
		fixedColumn = in.nextInt();
		int [][] matrix = matrixConductor(fixedRole,fixedColumn);
		int [][] isSaddlePoint = new int[fixedRole][fixedColumn];
		isMax(matrix,isSaddlePoint,fixedRole,fixedColumn);
		isMin(matrix,isSaddlePoint,fixedRole,fixedColumn);
		printSP(matrix,isSaddlePoint,fixedRole,fixedColumn);
		in.close();
//		long end=System.currentTimeMillis();
//		System.out.println("程序运行时间： "+(end-start)+"ms"); 
		//结束计时
	}
	
	public static int[][] matrixConductor (int role,int column)
	{
		int matrix [][]= new int[role][column];
		for(int i=0;i<role;i++)
		{
			for(int j=0;j<column;j++)
			{
				matrix[i][j] = (int)((Math.random()+1)*100);
				System.out.print(matrix[i][j]+" ");
			}
			System.out.println("");
		}
		return matrix;
	}
	
	public static void isMax(int [][]matrix,int [][]isSaddlePoint,int fixedRole,int fixedColumn) 
	{
		for(int i=0;i<fixedRole;i++)
		{
			int max = matrix[i][0];
			isSaddlePoint[i][0]++;
			for(int j=1;j<fixedColumn;j++)
				if(matrix[i][j]>=max)	max = matrix[i][j];
			
			for(int j=0;j<fixedColumn;j++)
				if(max==matrix[i][j])	isSaddlePoint[i][j]++;		
		}
	}
	
	public static void isMin(int [][]matrix,int [][]isSaddlePoint,int fixedRole,int fixedColumn) 
	{
		for(int j=0;j<fixedColumn;j++)
		{
			int min = matrix[0][j];
			for(int i=1;i<fixedRole;i++)
				if(matrix[i][j]<=min)	min = matrix[i][j];
			
			for(int i=0;i<fixedRole;i++)
				if(min==matrix[i][j])	isSaddlePoint[i][j]++;
		}
	}
	
	public static void printSP (int [][]matrix,int [][] isSaddlePoint,int fixedRole,int fixedColumn)
	{
		for(int i=0;i<fixedRole;i++)
			for(int j=0;j<fixedColumn;j++)
				if(isSaddlePoint[i][j]==2) 
					System.out.println("Coordinate: ("+(i+1)+","+(j+1)+")"+"   Number: "+matrix[i][j]);
	}
	
}
