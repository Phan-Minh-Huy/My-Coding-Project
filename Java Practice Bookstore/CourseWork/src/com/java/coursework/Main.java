package com.java.coursework;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;

public class Main {
	static Scanner sc = new Scanner(System.in);
	static ArrayList<Product> catalog = new ArrayList<>();
	static ArrayList<Customer> customers = new ArrayList<>();
	static Customer currentCustomer = null;
	static Admin admin = new Admin("admin", "123");
	static HashMap<String, Double> discountCodes = new HashMap<>();

	public static void main(String[] args) {
		seedData();
		loginMenu();
	}

	static void seedData() {
		catalog.add(new Product(1, "To Kill a Mockingbird", "Harper Lee", 10.85));
		catalog.add(new Product(2, "Alice's Adventures in Wonderland", "Lewis Carroll", 14.30));
		catalog.add(new Product(3, "Tuesdays with Morrie", "Mitch Albom", 12.00));
		catalog.add(new Product(4, "The Old Man and the Sea", "Ernest Hemingway", 13.80));
		catalog.add(new Product(5, "Peter Pan", "J. M. Barrie", 11.20));

		customers.add(new Customer("huy", "123"));
		customers.add(new Customer("phuong", "456"));
		customers.add(new Customer("steve", "789"));

		discountCodes.put("SALE10", 0.10);
		discountCodes.put("WELCOME", 0.15);
		discountCodes.put("BLACKFRIDAY", 0.50);
	}

	static void loginMenu() {
		while (true) {
			System.out.println("\n=== Welcome to OnlineBookStore ===");
			System.out.println("1. Customer Login");
			System.out.println("2. Admin Menu");
			System.out.println("3. Exit");
			System.out.print("Choice: ");
			int c = safeNextInt(sc);
			sc.nextLine();

			if (c == 1) {
				if (currentCustomer == null)
					handleCustomerLogin(sc);
				if (currentCustomer != null)
					customerMenu();
			} else if (c == 2) {
				handleAdminLogin(sc);
			} else {
				break;
			}
		}
		System.out.println("Goodbye!");
	}

	static void handleCustomerLogin(Scanner sc) {
		System.out.println("\n--- Customer Login ---");
		System.out.print("Enter username: ");
		String username = sc.nextLine();
		System.out.print("Enter password: ");
		String password = sc.nextLine();

		for (Customer cus : customers) {
			if (cus.username.equals(username) && cus.password.equals(password)) {
				currentCustomer = cus;
				System.out.println("Login successful! Welcome, " + cus.username + "!");
				return;
			}
		}
		System.out.println("Invalid username or password.");
	}

	static void handleAdminLogin(Scanner sc) {
		System.out.println("\n--- Admin Login ---");
		System.out.print("Enter username: ");
		String username = sc.nextLine();
		System.out.print("Enter password: ");
		String password = sc.nextLine();

		if (username.equals(admin.username) && password.equals(admin.password)) {
			System.out.println("Login successful. Welcome, " + admin.username + "!");
			adminMenu();
		} else {
			System.out.println("Access Denied. Invalid username or password.");
		}
	}

	static void customerMenu() {
		while (true) {
			System.out.println("\n=== CUSTOMER MENU (" + currentCustomer.username + ") ===");
			System.out.println("1. View Products");
			System.out.println("2. Sort Products by Price");
			System.out.println("3. Place Order");
			System.out.println("4. View Order History");
			System.out.println("5. Search Products");
			System.out.println("6. Search Order by ID");
			System.out.println("7. Delete an Order");
			System.out.println("8. Logout");
			System.out.print("Choice: ");
			int c = safeNextInt(sc);

			switch (c) {
			case 1:
				SortAlgorithm.displayProducts(catalog);
				break;
			case 2:
				sortMenuAndDisplay();
				break;
			case 3:
				currentCustomer.placeOrder(catalog, sc, discountCodes);
				break;
			case 4:
				currentCustomer.viewOrderHistory();
				break;
			case 5:
				sc.nextLine();
				searchProductsMenu(sc);
				break;
			case 6:
				currentCustomer.searchOrder(sc);
				break;
			case 7:
				currentCustomer.deleteOrder(sc);
				break;
			case 8:
				System.out.println("Logged out.");
				currentCustomer = null;
				return;
			default:
				System.out.println("Invalid selection.");
			}
		}
	}

	static void searchProductsMenu(Scanner sc) {
		System.out.println("\nEnter search term:");
		String searchTerm = sc.nextLine().toLowerCase();
		ArrayList<Product> foundProducts = new ArrayList<>();
		for (Product p : catalog) {
			if (p.title.toLowerCase().contains(searchTerm) || p.author.toLowerCase().contains(searchTerm)) {
				foundProducts.add(p);
			}
		}
		if (foundProducts.isEmpty())
			System.out.println("No products found.");
		else {
			System.out.println("--- Found " + foundProducts.size() + " products ---");
			SortAlgorithm.displayProducts(foundProducts);
		}
	}

	static void adminMenu() {
		while (true) {
			System.out.println("\n=== ADMIN MENU ===");
			System.out.println("1. View Products");
			System.out.println("2. Add Product");
			System.out.println("3. Delete Product");
			System.out.println("4. Manage Discount Codes");
			System.out.println("5. Exit to Main Menu");
			System.out.print("Choice: ");
			int c = safeNextInt(sc);
			sc.nextLine();

			if (c == 1)
				admin.viewProducts(catalog);
			else if (c == 2)
				admin.addProduct(catalog, sc);
			else if (c == 3)
				admin.deleteProduct(catalog, sc);
			else if (c == 4)
				manageDiscounts(sc);
			else if (c == 5)
				return;
		}
	}

	static void manageDiscounts(Scanner sc) {
		System.out.println("1. View Codes | 2. Add Code | 3. Delete Code");
		int c = safeNextInt(sc);
		sc.nextLine();
		if (c == 1) {
			if (discountCodes.isEmpty())
				System.out.println("No codes.");
			else
				discountCodes.forEach((k, v) -> System.out.println(k + ": " + (v * 100) + "%"));
		} else if (c == 2) {
			System.out.print("Code: ");
			String code = sc.nextLine().toUpperCase();
			System.out.print("Rate (0.1 = 10%): ");
			double rate = sc.nextDouble();
			discountCodes.put(code, rate);
			System.out.println("Added.");
		} else if (c == 3) {
			System.out.print("Code: ");
			String code = sc.nextLine().toUpperCase();
			discountCodes.remove(code);
			System.out.println("Removed.");
		}
	}

	static void sortMenuAndDisplay() {
		System.out.println("1.Bubble 2.Insertion 3.Selection 4.Quick 5.Merge");
		int algo = safeNextInt(sc);
		sc.nextLine();
		ArrayList<Product> sortedList = new ArrayList<>(catalog);
		switch (algo) {
		case 1:
			SortAlgorithm.bubbleSortByPrice(sortedList);
			break;
		case 2:
			SortAlgorithm.insertionSortByPrice(sortedList);
			break;
		case 3:
			SortAlgorithm.selectionSortByPrice(sortedList);
			break;
		case 4:
			SortAlgorithm.quickSortByPrice(sortedList);
			break;
		case 5:
			SortAlgorithm.mergeSortByPrice(sortedList);
			break;
		default:
			return;
		}
		SortAlgorithm.displayProducts(sortedList);
	}

	private static int safeNextInt(Scanner sc) {
		while (!sc.hasNextInt()) {
			sc.next();
		}
		return sc.nextInt();
	}
}