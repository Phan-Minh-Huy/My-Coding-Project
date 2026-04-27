import tkinter as tk
import tkinter.scrolledtext as tkst
from tkinter import messagebox
import tkinter.ttk as ttk
import message_manager as messages
import font_manager as fonts
from read_message import ReadMessage

import new_message
import label_messages

def set_text(text_area, content):
    text_area["state"] = "normal"
    text_area.delete("1.0", tk.END)
    text_area.insert(1.0, content)
    text_area["state"] = "disabled"


class EmailManager():
    def __init__(self, window):
        self.window = window
        self.window.geometry("1000x450")
        self.window.title("Email Manager")
        self.window.configure(bg="lightgrey")

        list_messages_btn = tk.Button(window, text="List Messages", command=self.list_messages, bg="#2196F3", fg="white",)
        list_messages_btn.grid(row=0, column=0, padx=5, pady=10)

        read_message_btn = tk.Button(window, text="Read Message:", command=self.read_message, bg="#00BCD4", fg="white")
        read_message_btn.grid(row=0, column=1, padx=5, pady=10)

        self.id_txt = tk.Entry(window, width=3)
        self.id_txt.grid(row=0, column=2, padx=5, pady=10)

        new_message_btn = tk.Button(window, text="New Message", command=self.new_message, bg="#4CAF50", fg="white")
        new_message_btn.grid(row=0, column=3, padx=5, pady=10)

        label_messages_btn = tk.Button(window, text="Label Messages", command=self.label_messages, bg="#FF9800", fg="white")
        label_messages_btn.grid(row=0, column=4, padx=5, pady=10)

        # Innovation : Sort
        tk.Label(window, text="Sort by:", bg="#f0f0f0").grid(row=1, column=0, sticky="E", padx=5)

        self.sort_combo = ttk.Combobox(window, width=10, state="readonly")
        self.sort_combo['values'] = ("Priority", "Sender", "Subject", "ID")
        self.sort_combo.current(0)
        self.sort_combo.grid(row=1, column=1, sticky="W", padx=5)

        sort_btn = tk.Button(window, text="Sort", command=self.sort_messages, bg="#9C27B0", fg="white" )
        sort_btn.grid(row=1, column=2, sticky="W", padx=5)

        #Innovation : Search
        tk.Label(window, text="Search:").grid(row=1, column=3, sticky="E", padx=5)

        self.search_txt = tk.Entry(window, width=15)
        self.search_txt.grid(row=1, column=4, sticky="W", padx=5)

        search_btn = tk.Button(window, text="Go", command=self.run_search, bg="#8B0000", fg="white")
        search_btn.grid(row=1, column=5, sticky="W", padx=5)

        # MESSAGE DISPLAY FRAME
        self.list_txt = tkst.ScrolledText(window, width=100, height=12, wrap="none")
        self.list_txt.grid(row=2, column=0, columnspan=6, sticky="W", padx=10, pady=10)

        # Status
        self.status_lbl = tk.Label(window, text="", font=("Helvetica", 10))
        self.status_lbl.grid(row=3, column=0, columnspan=6, sticky="W", padx=10, pady=10)

        # Run the list for the first time
        self.list_messages()
    def read_message(self):
        message_id_string = self.id_txt.get()
        valid = False
        if len(message_id_string) > 0:
            try:
                message_id = int(message_id_string) # number casting
                sender = messages.get_sender(message_id)
                if sender is not None:
                    ReadMessage(tk.Toplevel(self.window), message_id)
                    valid = True
                else:
                    messagebox.showwarning("Warning", "Message ID not found!")
                    return # Exit immediately to not run the valid = False line below
            except ValueError:
                # If you enter text not a number, its show here
                messagebox.showerror("Error", "ID must be a number!")
                return

        if not valid:
            messagebox.showinfo("WARNING", "You must select a valid message ID")
        self.status_lbl.configure(text="Read Message button was clicked!")

    def list_messages(self):
        message_list = messages.list_all()
        set_text(self.list_txt, message_list)
        self.status_lbl.configure(text="List Messages button was clicked!")

    def new_message(self):
        new_message.NewMessage(self.window)
        self.status_lbl.configure(text="New Message button was clicked!")

    def label_messages(self):
        label_messages.LabelMessages(self.window)
        self.status_lbl.configure(text="Label Messages button was clicked!")

    def sort_messages(self):
        # Get sort criteria
        criteria = self.sort_combo.get()

        # Get the keyword you are searching for
        keyword = self.search_txt.get()

        if criteria:
            # Pass both criteria and keyword to
            sorted_list = messages.sort_messages_by(criteria, keyword)

            # show the results
            set_text(self.list_txt, sorted_list)

            if keyword:
                self.status_lbl.configure(text=f"Sorted by {criteria} within search results for '{keyword}'")
            else:
                self.status_lbl.configure(text=f"Messages sorted by: {criteria}")

    def run_search(self):
        # Get keywords from the entry box
        keyword = self.search_txt.get()

        if keyword: #If the keyword is not empty (the user entered something)
            # Call the search function on message_manager
            result = messages.search_messages(keyword)

            # Display search results
            set_text(self.list_txt, result)
            self.status_lbl.configure(text=f"Search results for: '{keyword}'")
        else:
            # If the user has not entered anything and presses the Go button, a warning will appear.
            messagebox.showwarning("Warning", "Please enter a keyword to search.")
if __name__ == "__main__":
    window = tk.Tk()
    fonts.configure()
    EmailManager(window)
    window.mainloop()
