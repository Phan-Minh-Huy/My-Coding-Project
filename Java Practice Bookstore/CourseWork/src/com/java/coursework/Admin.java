package com.java.coursework;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.Scanner;

public class Admin extends User {
	public Admin(String u, String p) {
		super(u, p, true);
	}

	public void addProduct(ArrayList<Product> catalog, Scanner sc) {
		System.out.println("Enter ID:");
		int id = safeNextInt(sc);
		sc.nextLine();
		System.out.println("Enter Title:");
		String title = sc.nextLine();
		System.out.println("Enter Author:");
		String author = sc.nextLine();
		System.out.println("Enter Price :");
		double price = safeNextDouble(sc);

		for (Product existing : catalog) {
			if (existing.id == id) {
				System.out.println("ID already exists. Product not added.");
				return;
			}
		}
		catalog.add(new Product(id, title, author, price));
		System.out.println("Product added.");
	}

	public void deleteProduct(ArrayList<Product> catalog, Scanner sc) {
		System.out.println("Enter Product ID to delete:");
		int id = safeNextInt(sc);
		Iterator<Product> it = catalog.iterator();
		boolean removed = false;
		while (it.hasNext()) {
			if (it.next().id == id) {
				it.remove();
				removed = true;
				break;
			}
		}
		System.out.println(removed ? "Product removed." : "Product not found.");
	}

	public void viewProducts(ArrayList<Product> catalog) {
		System.out.println("=== Product Catalog ===");
		SortAlgorithm.displayProducts(catalog);
	}

	private int safeNextInt(Scanner sc) {
		while (!sc.hasNextInt()) {
			sc.next();
			System.out.println("Please enter a valid integer:");
		}
		return sc.nextInt();
	}

	private double safeNextDouble(Scanner sc) {
		while (!sc.hasNextDouble()) {
			sc.next();
			System.out.println("Please enter a valid number:");
		}
		return sc.nextDouble();
	}
}