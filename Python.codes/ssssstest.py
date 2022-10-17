import tkinter as tk
window = tk.Tk()
entry = tk.Entry()
textbox = tk.Text()
entry.pack()
textbox.pack()

lb=tk.Label(text="real python")
textbox.get("1.0")
'H'
textbox.get("1.0", "1.5")
'Hello'
textbox.get("2.0", "2.5")
'World'
textbox.get("1.0", tk.END)
'Hello\nWorld\n'
lb.pack()
entry.delete(1)
window.mainloop()
