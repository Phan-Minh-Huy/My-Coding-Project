package com.java.coursework;

public class OrderStack {
	private static class Node {
		Order data;
		Node next;

		Node(Order d) {
			data = d;
		}
	}

	private Node top;

	public void push(Order order) {
		Node n = new Node(order);
		n.next = top;
		top = n;
	}

	public Order pop() {
		if (top == null)
			return null;
		Order result = top.data;
		top = top.next;
		return result;
	}

	public boolean isEmpty() {
		return top == null;
	}
}