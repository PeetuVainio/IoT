import tkinter as tk

window = tk.Tk()

frame123 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame123.pack(side=tk.RIGHT)
frame134 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame134.pack(side=tk.RIGHT)
frame145 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame145.pack(side=tk.LEFT)
frame156 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame156.pack(side=tk.RIGHT)
frame167 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame167.pack()
frame177 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame177.pack()
frame1 = tk.Frame(master=window, width=50, height=50, bg="blue")
frame1.pack()
window.mainloop()