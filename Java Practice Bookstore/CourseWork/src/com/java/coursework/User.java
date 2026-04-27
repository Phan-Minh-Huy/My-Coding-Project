package com.java.coursework;

public class User { // Lớp Cha (Parent Class).
	// Các thuộc tính (Attributes)
	protected String username;
	protected String password;
	protected boolean isAdmin;

	// Hàm khởi tạo (Constructor)
	public User(String username, String password, boolean isAdmin) {
		this.username = username;
		this.password = password;
		this.isAdmin = isAdmin;
	}
}