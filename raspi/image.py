import pygame
import pygame.image
import pygame.camera
import subprocess
import string

pygame.init()
pygame.camera.init()
cam = pygame.camera.Camera("/dev/video0",(640,480))
cam.start()

def getBarcode():
	image = cam.get_image()
	pygame.image.save(image, "temp.png")
	p = subprocess.Popen("/usr/bin/zbarimg temp.png", stdout = subprocess.PIPE, stderr = subprocess.PIPE,shell=True)
	result, errors = p.communicate()
	answer = ""
	if result[:3] == "EAN" or result[:3] == "UPC":
		answer = result[string.find(result, ":") + 1 : string.find(result, "\n")]
	else:
		answer =  "fail"
	print(answer)
	return answer


