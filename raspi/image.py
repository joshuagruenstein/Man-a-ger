import pygame
import pygame.image
import pygame.camera
import os

pygame.init()
pygame.camera.init()

cam = pygame.camera.Camera("/dev/video0",(640,480))
cam.start()

while True:
	image = cam.get_image()
	image.save("TestCapture.png")

	#os.system("")