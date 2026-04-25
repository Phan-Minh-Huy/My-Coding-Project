class Message:
    def __init__(self, sender, subject, recipient, message, priority=0):
        self.sender = sender
        self.subject = subject
        self.recipient = recipient
        self.content = message
        self.label = ""
        self.priority = priority
        self.unread = False

    def info(self):
        return f"{self.stars():8} {self.sender:25} {self.label:5} {self.subject}"

    def stars(self):
        stars = ""
        for i in range(self.priority):
            stars += "*"
        return stars
