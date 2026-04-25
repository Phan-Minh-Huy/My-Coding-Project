import tkinter as tk  # Import the tkinter library as 'tk' to create the Graphical User Interface (GUI).
import tkinter.scrolledtext as tkst  # Import the ScrolledText widget which allows for a text area with a scrollbar.
import message_manager as messages  # Import message_manager.py to access email data and logic.
import font_manager as fonts  # Import font_manager.py to handle font styling across the app.

#Create a class ReadMessage
class ReadMessage():
    # The constructor method initializes the window and widgets when the class is called.
    def __init__(self, window, message_id):# # The constructor initializes the GUI window and stores the message ID.
        self.message_id = message_id  # Store the ID of the message to be displayed/edited.

        self.window = window  # Store the reference to the window object.
        self.window.geometry("500x320")  # Set the window dimensions to 500 pixels width and 320 pixels height.
        self.window.title(f"Read Message {message_id}")  # Set the window title, dynamically including the message ID.

    #GUI Widget Setup

        # SENDER

        sender_lbl = tk.Label(window, text="From:")# Create a label with text "From:"
        sender_lbl.grid(row=0, column=0, sticky="E", padx=10, pady=10) # Place label at row 0, column 0. sticky="E" aligns it to the East (right).Adding padding horizontal widget = 10 and vertical widget = 10.


        self.sender_txt = tk.Entry(window, width=40) # Create an Entry widget (single line text box) for the sender's email.
        # Place entry at row 0, column 1. columnspan=5 makes it span across 5 columns. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.
        self.sender_txt.grid(row=0, column=1, columnspan=5, sticky="W", padx=10, pady=10)

        # RECIPIENT
        recipient_lbl = tk.Label(window, text="To:") # Create a label with text "To:"
        recipient_lbl.grid(row=1, column=0, sticky="E", padx=10, pady=10)# Place label at row 1, column 0. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.


        self.recipient_txt = tk.Entry(window, width=40) # Create an Entry widget for the recipient's email.
        # Place entry at row 1, column 1. columnspan=5 makes it span across 5 columns. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.
        self.recipient_txt.grid(row=1, column=1, columnspan=5, sticky="W", padx=10, pady=10)

        # SUBJECT
        subject_lbl = tk.Label(window, text="Subject:")# Create a label with text "Subject:"
        subject_lbl.grid(row=2, column=0, sticky="E", padx=10, pady=10)# Place label at row 2, column 0. sticky="E" aligns it to the East (right).Adding padding horizontal widget = 10 and vertical widget = 10.

        self.subject_txt = tk.Entry(window, width=40) # Create an Entry widget for the email subject.
        # Place entry at row 2, column 1. columnspan=5 makes it span across 5 columns. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.
        self.subject_txt.grid(row=2, column=1, columnspan=5, sticky="W", padx=10, pady=10)

        # CONTENT
        self.content_txt = tkst.ScrolledText(window, width=48, height=6, wrap="word")# Create a ScrolledText widget for the message body. wrap="word" ensures whole words move to the next line.
        # Place entry at row 3, column 0. columnspan=6 makes it span across 6 columns. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.
        self.content_txt.grid(row=3, column=0, columnspan=6, sticky="W", padx=10, pady=10)

        # PRIORITY
        priority_lbl = tk.Label(window, text="New priority (1-5):")# Create a label prompting for new priority input.
        # Place entry at row 4, column 0. columnspan=2 makes it span across 2 columns. sticky="E" aligns to East (right).Adding padding horizontal widget = 10 and vertical widget = 10.
        priority_lbl.grid(row=4, column=0, columnspan=2, sticky="E", padx=10, pady=10)

        self.priority_txt = tk.Entry(window, width=3)# Create a small Entry widget (width=3) for typing the priority number.
        self.priority_txt.grid(row=4, column=2, sticky="W", padx=10, pady=10)# Place entry at row 4, column 2. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.

        # BUTTONS
        update_btn = tk.Button(window, text="Update", command=self.update_priority) # Create an "Update" button. command=self.update_priority links the click event to the update function.
        update_btn.grid(row=4, column=3, sticky="W", padx=10, pady=10)# Place entry at row 4, column 3. sticky="W" aligns to West (left).Adding padding horizontal widget = 10 and vertical widget = 10.

        delete_btn = tk.Button(window, text="Delete", command=self.delete_message) # Create a "Delete" button linked to the delete_message function.
        delete_btn.grid(row=4, column=4, padx=10, pady=10)# Place entry at row 4, column 4. Adding padding horizontal widget = 10 and vertical widget = 10.

        close_btn = tk.Button(window, text="Close", command=self.close)# Create a "Close" button linked to the close function.
        close_btn.grid(row=4, column=5, padx=10, pady=10)# Place entry at row 4, column 5. Adding padding horizontal widget = 10 and vertical widget = 10.

        #Data Loading Logic
        if message_id is not None:# Check if a valid message_id was passed.
            sender = messages.get_sender(message_id) # Retrieve the sender's email using the helper function from message_manager.
            if sender is not None:#If the sender exists (meaning the message exists in the database):
                self.sender_txt.insert(tk.END, sender) # Insert the sender string into the entry field.
                self.sender_txt.configure(state='readonly')# Set the state to 'readonly'(read-only) so the user cannot modify the sender.

                self.recipient_txt.insert(tk.END, messages.get_recipient(message_id))# Fetch, insert, and lock the recipient field.
                self.recipient_txt.configure(state='readonly')# Set the state to 'readonly'(read-only) so the recipient cannot modify.

                self.subject_txt.insert(tk.END, messages.get_subject(message_id)) # Fetch, insert, and lock the subject field.
                self.subject_txt.configure(state='readonly')# Set the state to 'readonly'(read-only) it can not be modified.

                self.content_txt.insert(tk.END, messages.get_content(message_id))# Fetch and insert the main message content.
            else:  # If message_id is valid but not found in Database, show error message.
                self.content_txt.insert(tk.END, 'No such message')

        self.content_txt["state"] = "disabled" # Disable editing of the message body text area (making it read-only).

    def delete_message(self):#call a function to delete the current message from the system.
        if self.message_id is not None: # If a valid ID exists, call the delete function in message_manager.
            messages.delete_message(self.message_id) # Call the delete_message function from the message_manager module using the current ID.
        self.close() # Close the window after deletion.

    def update_priority(self):
        if self.message_id is not None:# If a valid ID exists, update the priority.
            messages.set_priority(self.message_id, int(self.priority_txt.get())) # Get value from entry, convert to integer, and pass to message_manager.
        self.close()  # Close the window after update.

    def close(self):
        # Destroy the window object to close the GUI.
        self.window.destroy()

if __name__ == "__main__":
    window = tk.Tk()  # Create the main Tk root window.
    fonts.configure()  # Apply font settings.
    ReadMessage(window, None)  # Initialize the GUI with no message ID for testing.
    window.mainloop()  # Start the event loop to listen for user interactions.