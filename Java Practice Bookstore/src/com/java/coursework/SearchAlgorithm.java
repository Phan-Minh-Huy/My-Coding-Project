package com.java.coursework;

import java.util.List;

public class SearchAlgorithm {
	public static Order binarySearch(List<Order> orders, int targetId) {
		int left = 0, right = orders.size() - 1;
		int steps = 0;

		while (left <= right) {
			steps++;
			int mid = (left + right) / 2;
			if (orders.get(mid).orderId == targetId) {
				System.out.println(">> (Report) Search found after " + steps + " steps.");
				return orders.get(mid);
			} else if (orders.get(mid).orderId < targetId)
				left = mid + 1;
			else
				right = mid - 1;
		}
		System.out.println(">> (Report) Search failed after " + steps + " steps.");
		return null;
	}
}