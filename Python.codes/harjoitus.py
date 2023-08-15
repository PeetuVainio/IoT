import time
import RPi.GPIO as GPIO
import mariadb

  
GPIO.setmode(GPIO.BCM)
GPIO.setup(4, GPIO.IN)

conn = mariadb.connect(user="", password="", host="", database="")
cur = conn.cursor()

try:
    while True:
         if GPIO.input(4):
            cur.execute("INSERT INTO Liike_Peetu(arvo,aika) VALUES (true,now())")
            conn.commit()
            print("koodi toimii")
            time.sleep(0.1)
    
    else:
            print("ei toimi")
            time.sleep(0.1)
            cur.execute("INSERT INTO Liike(arvo,aika) VALUES (false,now())")
            conn.commit()
except:
     conn.close()
     GPIO.cleanup()
