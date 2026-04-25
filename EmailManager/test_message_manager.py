import pytest
import message_manager as manager
import os

# SETUP BEFORE TEST
# Change the real CSV file to another name to test without corrupting the data
TEST_CSV = 'test_emails.csv'


@pytest.fixture(autouse=True)
def setup_and_teardown():
    # 1. Before testing: Point the CSV file to the draft file
    original_csv = manager.CSV_FILE
    manager.CSV_FILE = TEST_CSV
    manager.messages = {}

    yield  # Run test here

    # After testing: Clean up draft files
    if os.path.exists(TEST_CSV):
        os.remove(TEST_CSV)
    manager.CSV_FILE = original_csv


# All tests

def test_add_new_message():
    # Test new messages
    manager.new_message("sender@test.com", "recipient@test.com", "Subject", "Content")

    # Check if dictionary is entered
    assert len(manager.messages) == 1
    msg = manager.messages[1]
    assert msg.sender == "sender@test.com"
    assert msg.subject == "Subject"


def test_get_details():
    # Create fake data
    manager.new_message("A", "B", "Sub", "Cont")

    # Test the get functions
    assert manager.get_sender(1) == "A"
    assert manager.get_recipient(1) == "B"
    assert manager.get_subject(1) == "Sub"
    assert manager.get_content(1) == "Cont"


def test_delete_message():
    # Create message ID 1
    manager.new_message("A", "B", "S", "C")
    assert 1 in manager.messages

    # Delete
    manager.delete_message(1)

    # Check if it's still available
    assert 1 not in manager.messages
    assert manager.get_sender(1) is None


def test_search_logic():
    # Create 2 messages
    manager.new_message("Alice", "B", "Hello World", "C")  # ID 1
    manager.new_message("Bob", "B", "Hi There", "C")  # ID 2

    # Test to find the word "Alice"
    result = manager.search_messages("Alice")
    assert "Alice" in result
    assert "Bob" not in result

    # Test to find the word "World" (in Subject)
    result_subject = manager.search_messages("World")
    assert "Hello World" in result_subject