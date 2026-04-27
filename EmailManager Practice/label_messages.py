import tkinter as tk
import tkinter.scrolledtext as tkst

import message_manager as messages

#Call a Label_Messages class and function.
class LabelMessages():
    def __init__(self, master):
        self.window = tk.Toplevel(master)
        self.window.geometry("600x320")
        self.window.title("Label Messages")

        #Section 1: Filter Messages
        # List button and Filter input box
        btn_list = tk.Button(self.window, text="List All Messages Labelled:", command=self.list_by_label)
        btn_list.grid(row=0, column=0, padx=10, pady=10, sticky="E")

        self.entry_filter = tk.Entry(self.window, width=20)
        self.entry_filter.grid(row=0, column=1, columnspan=2, padx=10, pady=10, sticky="W")

        # Section 2: Add Label
        # Enter the Label name
        tk.Label(self.window, text="Enter Label:").grid(row=1, column=0, sticky="E", padx=10, pady=5)
        self.entry_new_label = tk.Entry(self.window, width=10)
        self.entry_new_label.grid(row=1, column=1, columnspan=2, sticky="W", padx=10, pady=5)

        # Enter message ID
        tk.Label(self.window, text="Enter Message ID:").grid(row=2, column=0, sticky="E", padx=10, pady=5)
        self.entry_id = tk.Entry(self.window, width=5)
        self.entry_id.grid(row=2, column=1, sticky="W", padx=10, pady=5)

        #Button"Add Label"
        btn_add = tk.Button(self.window, text="Add Label", command=self.add_label)
        btn_add.grid(row=2, column=2, padx=10, pady=5, sticky="W")

        #Section 3: Result Display

        # Text display frame
        self.text_display = tkst.ScrolledText(self.window, width=62, height=6, wrap="none")
        self.text_display.grid(row=3, column=0, columnspan=3, padx=15, pady=10)

        # Close button
        tk.Button(self.window, text="Close", command=self.window.destroy, width=10).grid(row=4, column=2, pady=10,
                                                                                         sticky="E", padx=15)

    def list_by_label(self):
        target = self.entry_filter.get()
        result = messages.list_all(label=target)
        self.text_display.delete("1.0", tk.END)
        self.text_display.insert("1.0", result)

    def add_label(self):
        label = self.entry_new_label.get()
        msg_id_str = self.entry_id.get()

        if label and msg_id_str:
            try:
                msg_id = int(msg_id_str)
                messages.set_label(msg_id, label)

                self.text_display.delete("1.0", tk.END)
                self.text_display.insert("1.0", f"Label '{label}' added to Message {msg_id}")
            except ValueError:
                self.text_display.insert("1.0", "Error: Message ID must be a number.")