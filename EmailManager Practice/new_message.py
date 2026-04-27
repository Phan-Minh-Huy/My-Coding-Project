import tkinter as tk  # Import tkinter library for GUI.
import message_manager as messages  # Import message_manager to save new messages.
from tkinter import messagebox

class NewMessage():
    def __init__(self, master):
        self.window = tk.Toplevel(master)  # Create a new window on top of the main window.
        self.window.geometry("500x350")  # Set the window dimensions to 500x350 pixels.
        self.window.title("Compose New Message")  # Set the window title.

        #GUI Setup

        # SENDER
        tk.Label(self.window, text="From:").grid(row=0, column=0, sticky="E", padx=10, pady=5) # Create Label "From", align East (right).
        self.entry_from = tk.Entry(self.window, width=40) # Create Entry for Sender.
        self.entry_from.grid(row=0, column=1, padx=10, pady=5) # Place Entry at row 0, column 1.

        # RECIPIENT
        tk.Label(self.window, text="To:").grid(row=1, column=0, sticky="E", padx=10, pady=5) # Create Label "To", align East (right).
        self.entry_to = tk.Entry(self.window, width=40) # Create Entry for Recipient.
        self.entry_to.grid(row=1, column=1, padx=10, pady=5) # Place Entry at row 1, column 1.

        # SUBJECT
        tk.Label(self.window, text="Subject:").grid(row=2, column=0, sticky="E", padx=10, pady=5) # Create Label "Subject", align East (right).
        self.entry_subject = tk.Entry(self.window, width=40) # Create Entry for Subject.
        self.entry_subject.grid(row=2, column=1, padx=10, pady=5) # Place Entry at row 2, column 1.

        # MESSAGE BODY
        tk.Label(self.window, text="Message:").grid(row=3, column=0, sticky="NE", padx=10, pady=5) # Create Label "Message", align North-East (top-right).
        self.text_body = tk.Text(self.window, width=30, height=8) # Create Text area for message content.
        self.text_body.grid(row=3, column=1, padx=10, pady=5) # Place Text area at row 3, column 1.

        # BUTTONS
        btn_send = tk.Button(self.window, text="Send", command=self.send_email) # Create "Send" button linked to send_email function.
        btn_send.grid(row=4, column=1, sticky="W", padx=10, pady=10) # Place button aligned West (left).

        btn_cancel = tk.Button(self.window, text="Cancel", command=self.window.destroy) # Create "Cancel" button to close window.
        btn_cancel.grid(row=4, column=1, sticky="E", padx=10, pady=10) # Place button aligned East (right).

    def send_email(self):
        sender = self.entry_from.get()
        recipient = self.entry_to.get()
        subject = self.entry_subject.get()
        content = self.text_body.get("1.0", tk.END)
        if not sender or not recipient or not subject:
            messagebox.showwarning("Warning", "Please fill in all fields.")
            return

        if "@" not in sender:
            messagebox.showerror("Error", "Invalid Sender email: Must contain '@'")
            return

        if "@" not in recipient:
            messagebox.showerror("Error", "Invalid Recipient email: Must contain '@'")
            return
        messages.new_message(sender, recipient, subject, content)
        messagebox.showinfo("Success", "Message sent successfully!")
        self.window.destroy()

