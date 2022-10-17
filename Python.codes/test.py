import tkinter as tk
root = tk. Tk()

message = tk. Label(root, text="heippa porukka")
message.pack()

label = tk.Label(text="heippa maailma")
label.pack()

entry = tk.Entry()
entry.pack()

radioBtn = tk.Radiobutton(text="A", value= "A")
radioBtn.pack()
radioBtn = tk.Radiobutton(text="B", value= "B")
radioBtn.pack()





root.mainloop()
