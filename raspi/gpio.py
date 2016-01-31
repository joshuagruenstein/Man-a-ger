import os
from time import sleep
 
import RPi.GPIO as GPIO
 
GPIO.setmode(GPIO.BCM)
GPIO.setup(4, GPIO.IN)

justEmpty = True
state = True

def speakState():
	input = "Adding." if state else "Removing."
	os.system('espeak -v en -k5 -s150 "' + input + '"')
 
while True:
	if not GPIO.input(4):
		if justEmpty:
			justEmpty = False
			state = not state
			speakState()		
	else:
		justEmpty = True	
	sleep(0.05)
