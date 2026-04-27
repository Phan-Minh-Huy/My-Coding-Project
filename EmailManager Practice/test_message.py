import pytest
from message import Message


# Test 1: Check if the message is created correctly
def test_message_initialization():
    sender = "me@test.com"
    subject = "Meeting"
    recipient = "you@test.com"
    content = "Hello there"
    priority = 3

    msg = Message(sender, subject, recipient, content, priority)

    assert msg.sender == sender
    assert msg.subject == subject
    assert msg.priority == 3


# Test 2: Check if the stars() function prints the correct number of stars
def test_priority_stars():
    # Priority 1 -> Must be "*"
    msg1 = Message("a", "b", "c", "d", 1)
    assert msg1.stars() == "*"

    # Priority 5 -> Must be "*****"
    msg5 = Message("a", "b", "c", "d", 5)
    assert msg5.stars() == "*****"


# Test 3: Check the info() function
def test_message_info():
    msg = Message("sender", "Subject", "recip", "content", 1)
    info = msg.info()

    # Check if the info string contains Sender and Subject
    assert "sender" in info
    assert "Subject" in info