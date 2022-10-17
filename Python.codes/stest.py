import tkinter as tk

root = tk.Tk()




message = tk. Label(
        text="heippa porukka",
        foreground="white",
        background="black",
        width=60,
        height=50
        )
message.pack()

btn=tk.Button(
    text="nappi",
    width=5,
    height=1,
    bg="blue",
    fg="yellow"
    )
btn.pack()

entry = tk.Entry(
    fg="yellow",
    bg="blue",
    width=50
    )
entry.pack()

    
    

root.mainloop()