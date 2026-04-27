	package com.java.coursework;

public class Product {
    int id;
    String title;
    String author;
    double price;

    public Product(int id, String title, String author, double price) {
        this.id = id;
        this.title = title;
        this.author = author;
        this.price = price;
    }
    
    @Override
    public String toString() {
        return String.format("%d. %s by %s - $%.2f", id, title, author, price);
    }
}