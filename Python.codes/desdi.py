from tkinter import *

tkWindow = Tk()
tkWindow.geometry('400x150')
tkWindow.title('Button Background')

button = Button(tkWindow, text = 'Submit', bg= '#ff66b3', fg='#000000')
button.pack()

tkWindow.mainloop