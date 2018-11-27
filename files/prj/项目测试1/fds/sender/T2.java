package projectOne;

import java.util.Scanner;

public class T2 {

	public static void main(String[] args) {
//		long start=System.currentTimeMillis();
		Scanner in = new Scanner(System.in);
		int fixedRole = 6, fixedColumn =8;
		fixedRole = in.nextInt();
		fixedColumn = in.nextInt();
		int [][] matrix = matrixConductor(fixedRole,fixedColumn);
		isSaddlePoint(matrix,fixedRole,fixedColumn);
		in.close();
//		long end=System.currentTimeMillis();
//		System.out.println("程序运行时间： "+(end-start)+"ms"); 
	}
	
	public static void isSaddlePoint(int [][] matrix,int fixedRole,int fixedColumn)
	{
		boolean isSaddlePoint = false;
		for(int i = 0;i<fixedRole;i++)
		{
			for(int j = 0;j<fixedColumn;j++)
			{
				if(isMax(matrix,i,fixedColumn,matrix[i][j])&&isMin(matrix,j,fixedRole,matrix[i][j]))
				{
					System.out.println("Coordinate: ("+(i+1)+","+(j+1)+")"+"   Number: "+matrix[i][j]);
					isSaddlePoint = true;
				}
			}
		}
		if(!isSaddlePoint)
		{
			System.out.println("No Saddle Point");
		}
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
	
	public static boolean isMax(int[][] matrix,int role,int fixedColumn,int num)
	{
		boolean flag = true;
		for(int j = 0;j<fixedColumn;j++)
		{
			if(num<matrix[role][j])
			{
				flag = false;
				break;
			}
		}
		return flag;
	}
	
	public static boolean isMin(int[][] matrix,int column,int fixedRole,int num)
	{
		boolean flag = true;
		for(int i = 0;i<fixedRole;i++)
		{
			if(num>matrix[i][column])
			{
				flag = false;
				break;
			}
		}
		return flag;
	}
	
}


