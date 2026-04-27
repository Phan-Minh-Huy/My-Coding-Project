package com.java.coursework;

import java.util.ArrayList;
import java.util.Collections;

public class SortAlgorithm {

	// 1. BUBBLE SORT
	public static void bubbleSortByPrice(ArrayList<Product> list) {
		long startTime = System.nanoTime();
		int n = list.size();
		for (int i = 0; i < n - 1; i++) {
			boolean swapped = false;
			for (int j = 0; j < n - 1 - i; j++) {
				if (list.get(j).price > list.get(j + 1).price) {
					Collections.swap(list, j, j + 1);
					swapped = true;
				}
			}
			if (!swapped)
				break;
		}
		long endTime = System.nanoTime();
		System.out.println(">> (Report) Bubble Sort Time: " + (endTime - startTime) + " ns");
	}

	// 2. INSERTION SORT
	public static void insertionSortByPrice(ArrayList<Product> list) {
		long startTime = System.nanoTime();
		for (int i = 1; i < list.size(); i++) {
			Product key = list.get(i);
			int j = i - 1;
			while (j >= 0 && list.get(j).price > key.price) {
				list.set(j + 1, list.get(j));
				j--;
			}
			list.set(j + 1, key);
		}
		long endTime = System.nanoTime();
		System.out.println(">> (Report) Insertion Sort Time: " + (endTime - startTime) + " ns");
	}

	// 3. SELECTION SORT
	public static void selectionSortByPrice(ArrayList<Product> list) {
		long startTime = System.nanoTime();
		int n = list.size();
		for (int i = 0; i < n - 1; i++) {
			int minIdx = i;
			for (int j = i + 1; j < n; j++) {
				if (list.get(j).price < list.get(minIdx).price)
					minIdx = j;
			}
			if (minIdx != i)
				Collections.swap(list, i, minIdx);
		}
		long endTime = System.nanoTime();
		System.out.println(">> (Report) Selection Sort Time: " + (endTime - startTime) + " ns");
	}

	// 4. QUICK SORT
	public static void quickSortByPrice(ArrayList<Product> list) {
		long startTime = System.nanoTime();
		quickSortHelper(list, 0, list.size() - 1);
		long endTime = System.nanoTime();
		System.out.println(">> (Report) Quick Sort Time: " + (endTime - startTime) + " ns");
	}

	private static void quickSortHelper(ArrayList<Product> list, int low, int high) {
		if (low < high) {
			int p = partition(list, low, high);
			quickSortHelper(list, low, p - 1);
			quickSortHelper(list, p + 1, high);
		}
	}

	private static int partition(ArrayList<Product> list, int low, int high) {
		double pivot = list.get(high).price;
		int i = low - 1;
		for (int j = low; j < high; j++) {
			if (list.get(j).price <= pivot) {
				i++;
				Collections.swap(list, i, j);
			}
		}
		Collections.swap(list, i + 1, high);
		return i + 1;
	}

	// 5. MERGE SORT
	public static void mergeSortByPrice(ArrayList<Product> list) {
		long startTime = System.nanoTime();
		if (list.size() > 1)
			mergeSortHelper(list, 0, list.size() - 1);
		long endTime = System.nanoTime();
		System.out.println(">> (Report) Merge Sort Time: " + (endTime - startTime) + " ns");
	}

	private static void mergeSortHelper(ArrayList<Product> list, int left, int right) {
		if (left >= right)
			return;
		int mid = left + (right - left) / 2;
		mergeSortHelper(list, left, mid);
		mergeSortHelper(list, mid + 1, right);
		mergeRanges(list, left, mid, right);
	}

	private static void mergeRanges(ArrayList<Product> list, int left, int mid, int right) {
		ArrayList<Product> temp = new ArrayList<>();
		int i = left, j = mid + 1;
		while (i <= mid && j <= right) {
			if (list.get(i).price <= list.get(j).price)
				temp.add(list.get(i++));
			else
				temp.add(list.get(j++));
		}
		while (i <= mid)
			temp.add(list.get(i++));
		while (j <= right)
			temp.add(list.get(j++));
		for (int k = 0; k < temp.size(); k++)
			list.set(left + k, temp.get(k));
	}

	public static void displayProducts(ArrayList<Product> list) {
		if (list.isEmpty()) {
			System.out.println("No products found.");
			return;
		}
		for (Product p : list) {
			System.out.println(p.toString());
		}
	}
}