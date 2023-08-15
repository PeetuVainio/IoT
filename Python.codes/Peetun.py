import time
import RPi.GPIO as GPIO
import mariadb
import datetime

GPIO.setmode(GPIO.BCM)
GPIO.setup(4, GPIO.IN)
conn = mariadb.connect(user="", password="", host="", database="")
cur = conn.cursor()
dt = datetime.datetime.now()
try:
    while True: 
        if GPIO.input(4):
            cur.execute("INSERT INTO Liike_Luca(arvo,aika) VALUES (true,now())")
            conn.commit()
            print("koodi toimii: ",dt.strftime("%X"))
            time.sleep(1)
    else:
            print("ei toimi: ",dt.strftime("%X"))  
            time.sleep(0.1)
            ur.execute("INSERT INTO Liike(arvo,aika) VALUES (false,now())")
            conn.commit()
except:
    conn.close() 
    GPIO.cleanup()
