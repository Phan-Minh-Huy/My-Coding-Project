package com.java.coursework;

import java.util.ArrayList; // 1. Import thư viện mảng động

public class Order { // 2. Định nghĩa đối tượng Đơn hàng
	int orderId;
	String status = "Pending";
	ArrayList<Product> items = new ArrayList<>(); //Biến items được coi như là một cái túi chứa các cuốn sách (Product) mà khách đã chọn.

	// Thông tin khách hàng và tính toán
	String customerName;
	String shippingAddress;
	public double subTotal;
	public double discountAmount;
	public double finalTotal;

	public Order(int orderId, String customerName, String shippingAddress) {
		this.orderId = orderId;
		this.customerName = customerName;
		this.shippingAddress = shippingAddress;
		this.subTotal = 0;
		this.discountAmount = 0;
		this.finalTotal = 0;
	}
}