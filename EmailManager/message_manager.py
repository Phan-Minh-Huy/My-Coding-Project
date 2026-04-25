import csv
import os
from message import Message

# File name to save data
CSV_FILE = 'emails.csv'

messages = {}


# CSV FILE PROCESSING (Save & Read)

def save_data():
    #Write the entire dictionary messages to a CSV file.
    with open(CSV_FILE, mode='w', newline='', encoding='utf-8') as file:
        writer = csv.writer(file)
        # Header
        writer.writerow(['ID', 'Sender', 'Subject', 'Recipient', 'Content', 'Priority', 'Label', 'Unread'])

        # Write each message to the CSV
        for msg_id, msg in messages.items():
            writer.writerow([
                msg_id,
                msg.sender,
                msg.subject,
                msg.recipient,
                msg.content,
                msg.priority,
                msg.label,
                msg.unread
            ])


def load_data():
    #Read data from CSV file (if any) into dictionary
    if not os.path.exists(CSV_FILE):
        return False

    try:
        with open(CSV_FILE, mode='r', newline='', encoding='utf-8') as file:
            reader = csv.reader(file)
            next(reader)  # Skip subject line
            messages.clear()

            for row in reader:
                if row:
                    msg_id = int(row[0])
                    sender = row[1]
                    subject = row[2]
                    recipient = row[3]
                    content = row[4]
                    priority = int(row[5])
                    label = row[6]
                    unread_str = row[7]

                    # Create Message object
                    new_msg = Message(sender, subject, recipient, content, priority)
                    new_msg.label = label
                    new_msg.unread = (unread_str == 'True')  # Convert string to Boolean

                    messages[msg_id] = new_msg
        return True
    except Exception as e:
        print(f"Error loading CSV: {e}")
        return False


def create_sample_data():
    #Create sample data
    messages[1] = Message("A.Tutor@grandwich.ac.uk", "Hello", "B.Tutor@grandwich.ac.uk", "How is the course going?", 2)
    messages[2] = Message("B.Tutor@grandwich.ac.uk", "Re: Hello", "A.Tutor@grandwich.ac.uk",
                          "> How is the course going?\n\nBrilliant, thanks.", 2)
    messages[3] = Message("A.Friend@kmail.com", "Coffee", "A.Tutor@grandwich.ac.uk", "Fancy meeting for coffee?", 5)
    messages[4] = Message("A.Tutor@grandwich.ac.uk", "Exam", "C.Tutor@grandwich.ac.uk",
                          "I have nearly finished writing the exam.", 4)
    messages[5] = Message("A.Student@grandwich.ac.uk", "Timetable", "A.Tutor@grandwich.ac.uk",
                          "Help! My timetable is rubbish.", 0)
    messages[6] = Message("A.Tutor@grandwich.ac.uk", "Re: Timetable", "A.Student@grandwich.ac.uk",
                          "Please follow the advice on Moodle.", 0)
    messages[7] = Message("Marketing@spam.com", "Free Pizza", "You@grandwich.ac.uk", "Click here for pizza!", 0)

    messages[8] = Message("N.Frost@grandwich.ac.uk", "Coursework Deadline", "All.Students@grandwich.ac.uk",
                          "URGENT: Just a reminder that the Python coursework is due this Friday at 23:30. No extensions!",
                          5)

    messages[9] = Message("B.Student@grandwich.ac.uk", "Lost ID Card", "Security@grandwich.ac.uk",
                          "Hi, I think I left my ID card in the computer lab (QA035). Has anyone handed it in?", 1)

    messages[10] = Message("IT.Support@grandwich.ac.uk", "System Maintenance", "All.Staff@grandwich.ac.uk",
                           "Moodle will be offline for maintenance this Saturday from 00:00 to 04:00.", 5)

    messages[11] = Message("Library@grandwich.ac.uk", "Overdue Book", "A.Student@grandwich.ac.uk",
                           "You have an overdue book: 'Introduction to Python'. Please return it to avoid a fine.", 4)

    messages[12] = Message("Marketing@spam-mail.com", "Free Pizza!", "A.Student@grandwich.ac.uk",
                           "Click this link to win free pizza for a year!!! Don't miss out.", 0)

    messages[13] = Message("Mom@family.com", "Lunch on Sunday?", "A.Student@grandwich.ac.uk",
                           "Are you coming home this weekend? I'm making your favorite lasagna.", 2)

    messages[14] = Message("C.Tutor@grandwich.ac.uk", "Staff Meeting", "A.Tutor@grandwich.ac.uk",
                           "The department meeting has been moved to Room 304. See you there at 2pm.", 3)

    messages[15] = Message("A.Student@grandwich.ac.uk", "Re: Exam", "A.Tutor@grandwich.ac.uk",
                           "Could you please clarify what topics will be covered in Section B? Thanks.", 3)
    save_data()  # Save this to a file for later use.


# Loading File if not create a new one.
if not load_data():
    create_sample_data()


#  Basic Function

def list_all(label=None):
    # 1. Header
    output = "ID   Priority   From                                Label                Subject\n" \
             "===  ========   =================================== ==================== =======\n"
    for message_id in messages:
        message = messages[message_id]
        if label is not None and (len(label) == 0 or label not in message.label):
            continue

        # Solving [NEW]
        prefix = "[NEW] " if message.unread else ""
        row_string = f"{message_id:<4} {message.stars():<10} {message.sender:<35} {message.label:<20} {prefix}{message.subject}"

        output += row_string + "\n"
    return output


def get_sender(message_id):
    try:
        return messages[message_id].sender
    except KeyError:
        return None


def get_recipient(message_id):
    try:
        return messages[message_id].recipient
    except KeyError:
        return None


def get_subject(message_id):
    try:
        return messages[message_id].subject
    except KeyError:
        return None


def get_content(message_id):
    try:
        message = messages[message_id]

        # Unread Status
        if message.unread:  # If it is a new message
            message.unread = False  # Convert to already read
            save_data()  # Save into CSV immediately

        return message.content
    except KeyError:
        return None


def get_priority(message_id):
    try:
        return messages[message_id].priority
    except KeyError:
        return -1


def get_unread(message_id):
    try:
        return messages[message_id].unread
    except KeyError:
        return -1


# DATA MODIFICATION FUNCTIONS (Requires call save_data)

def set_priority(message_id, priority):
    try:
        messages[message_id].priority = priority
        save_data()  # <--- Save immediately
    except KeyError:
        return


def set_label(message_id, label):
    try:
        messages[message_id].label = label
        save_data()  # <--- Save immediately
    except KeyError:
        return


def delete_message(message_id):
    if message_id in messages:
        messages.pop(message_id)
        save_data()  # <--- Save immediately

def new_message(sender, recipient, subject, content):
    if len(messages) > 0:
        message_id = max(messages.keys()) + 1
    else:
        message_id = 1

    # Create a message
    msg = Message(sender, subject, recipient, content, 0)
    msg.unread = True  #  Default is new message (True)

    messages[message_id] = msg
    save_data()  # <--- Save immediately


# Innovations

def filter_and_sort_messages(keyword, sort_criteria):
    output = "ID   Priority   From                                Label                Subject\n" \
             "===  ========   =================================== ==================== =======\n"

    all_items = messages.items()
    filtered_items = []
    keyword = keyword.lower()
    if keyword:
        for item in all_items:
            msg = item[1]
            if (keyword in msg.sender.lower()) or (keyword in msg.subject.lower()):
                filtered_items.append(item)
    else:
        filtered_items = list(all_items)

    if sort_criteria == "Priority":
        final_list = sorted(filtered_items, key=lambda x: x[1].priority, reverse=True)
    elif sort_criteria == "Sender":
        final_list = sorted(filtered_items, key=lambda x: x[1].sender.lower())
    elif sort_criteria == "Subject":
        final_list = sorted(filtered_items, key=lambda x: x[1].subject.lower())
    else:
        final_list = sorted(filtered_items, key=lambda x: x[0])

    if not final_list:
        return f"No messages found matching '{keyword}'"

    for message_id, message in final_list:
        prefix = "[NEW] " if message.unread else ""
        row_string = f"{message_id:<4} {message.stars():<10} {message.sender:<35} {message.label:<20} {prefix}{message.subject}"
        output += row_string + "\n"

    return output


# Keep the old function to avoid errors if the GUI side still calls (Wrapper)
def search_messages(keyword):
    return filter_and_sort_messages(keyword, "ID")


def sort_messages_by(criteria, keyword=""): # Add keyword parameter
    return filter_and_sort_messages(keyword, criteria)