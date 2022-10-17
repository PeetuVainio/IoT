import tkinter as tk
from tkinter import *
from tkinter import ttk
from tkinter.messagebox import showinfo
tkWindow = Tk()

tkWindow.geometry('400x150')
tkWindow.title('Button Background')






tkWindow.geometry('400x150')
tkWindow.title('Button Background')


ttk.Label(frame, text='Heippa maailma').grid(column=3, row=2)
 


       
def main_window():
#window Settings
    root = tk.Tk()
    root.geometry('600x400')
    root.configure(bg= '#ff66b3')
    root.title('Frigman Graafisen ohjeiston mukaan')
    root.resizable(False, False)
#---
    header = create_header(root)
    header.grid(column=3, row=3)

#---
    root.mainloop()
if __name__=="__main__":
    main_window()
    Window.mainloop()
    