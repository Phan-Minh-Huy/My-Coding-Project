package com.java.coursework;

import java.util.LinkedList;
import java.util.List;

public class OrderQueue {
    LinkedList<Order> queue = new LinkedList<>();

    public void enqueue(Order order) {
        queue.addLast(order);
    }

    public Order dequeue() {
        return queue.pollFirst();
    }

    public boolean isEmpty() {
        return queue.isEmpty();
    }

    public List<Order> getAll() {
        return queue;
    }
}