package com.java.coursework;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.HashMap;
import java.util.List;
import java.util.Scanner;

public class Customer extends User {
	OrderQueue orderHistory = new OrderQueue();
	OrderStack orderStack = new OrderStack();

	public Customer(String u, String p) {
		super(u, p, false);
	}

	public void placeOrder(ArrayList<Product> catalog, Scanner sc, HashMap<String, Double> discountCodes) {
		System.out.println("Enter Order ID: ");
		int id = safeNextInt(sc);
		sc.nextLine();

		System.out.println("Enter Shipping Address: ");
		String address = sc.nextLine();

		Order order = new Order(id, this.username, address);
		double currentSubTotal = 0.0;

		System.out.println("How many books? ");
		int count = safeNextInt(sc);

		for (int i = 0; i < count; i++) {
			System.out.println("Enter Product ID: ");
			int pid = safeNextInt(sc);
			boolean found = false;
			for (Product p : catalog) {
				if (p.id == pid) {
					order.items.add(p);
					currentSubTotal += p.price;
					found = true;
					break;
				}
			}
			if (!found)
				System.out.println("Product not found!");
		}

		if (order.items.isEmpty()) {
			System.out.println("Order cancelled (no items added).");
			return;
		}

		System.out.printf("Subtotal: $%.2f%n", currentSubTotal);
		order.subTotal = currentSubTotal;

		System.out.print("Enter discount code (or press Enter to skip): ");
		sc.nextLine();
		String code = sc.nextLine();

		double discountRate = discountCodes.getOrDefault(code, 0.0);
		if (discountRate > 0) {
			order.discountAmount = currentSubTotal * discountRate;
			System.out.printf("Code '%s' applied! Saved $%.2f%n", code, order.discountAmount);
		} else {
			order.discountAmount = 0;
			if (!code.isEmpty())
				System.out.println("Invalid or expired code.");
		}

		order.finalTotal = order.subTotal - order.discountAmount;
		System.out.printf("FINAL TOTAL: $%.2f%n", order.finalTotal);

		orderHistory.enqueue(order);
		orderStack.push(order);

		System.out.println("Order placed successfully! Delivering to: " + address);
	}

	public void viewOrderHistory() {
		List<Order> all = orderHistory.getAll();
		if (all.isEmpty()) {
			System.out.println("No orders yet.");
			return;
		}
		System.out.println("--- Your Order History ---");
		for (Order o : all) {
			System.out.println("--------------------------");
			System.out.println("Order #" + o.orderId + " | Status: " + o.status + " | Addr: " + o.shippingAddress);
			for (Product p : o.items) {
				System.out.printf("  - %s ($%.2f)%n", p.title, p.price);
			}
			System.out.printf("  Final Total: $%.2f%n", o.finalTotal);
		}
	}

	public void searchOrder(Scanner sc) {
		List<Order> list = new ArrayList<>(orderHistory.getAll());
		if (list.isEmpty()) {
			System.out.println("No orders to search.");
			return;
		}
		list.sort(Comparator.comparingInt(o -> o.orderId));

		System.out.println("Enter Order ID to search: ");
		int id = safeNextInt(sc);

		Order result = SearchAlgorithm.binarySearch(list, id);
		if (result == null) {
			System.out.println("Order not found.");
		} else {
			System.out.println("--- Found Order ---");
			System.out.println("Order #" + result.orderId + " | Addr: " + result.shippingAddress);
			for (Product p : result.items) {
				System.out.printf("  - %s ($%.2f)%n", p.title, p.price);
			}
			System.out.printf("  Final Total: $%.2f%n", result.finalTotal);

			if (result.items.size() > 1) {
				System.out.println("\nDo you want to sort items in this order by price? (1. Yes / 0. No)");
				int sortChoice = safeNextInt(sc);
				if (sortChoice == 1) {
					SortAlgorithm.quickSortByPrice(result.items);
					System.out.println(">> Items sorted using QuickSort:");
					SortAlgorithm.displayProducts(result.items);
				}
			}
		}
	}

	public void deleteOrder(Scanner sc) {
		System.out.println("Enter Order ID to delete: ");
		int idToDelete = safeNextInt(sc);

		boolean removedFromQueue = orderHistory.queue.removeIf(order -> order.orderId == idToDelete);

		OrderStack tempStack = new OrderStack();
		boolean foundInStack = false;
		while (!orderStack.isEmpty()) {
			Order order = orderStack.pop();
			if (order.orderId == idToDelete)
				foundInStack = true;
			else
				tempStack.push(order);
		}
		while (!tempStack.isEmpty())
			orderStack.push(tempStack.pop());

		if (removedFromQueue && foundInStack) {
			System.out.println("Successfully removed Order #" + idToDelete + " from history.");
		} else {
			System.out.println("Order #" + idToDelete + " not found in history.");
		}
	}

	private int safeNextInt(Scanner sc) {
		while (!sc.hasNextInt()) {
			sc.next();
			System.out.println("Please enter a valid integer:");
		}
		return sc.nextInt();
	}
}