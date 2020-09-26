from pyimagesearch.shapedetector import ShapeDetector
import imutils
import cv2
import sys
import numpy as np
import math
import json


def get_block(image, oracle, split):
	# Get the distance of unit
	unit_X = np.shape(image)[0]/split[0]
	unit_Y = np.shape(image)[1]/split[1]

	# Get the row ID and return in data
	data = []
	for instance in oracle:
		row = math.floor(instance[1][1]/unit_X)
		data.append([instance[0], row])
	data = np.array(data)

	# Get the set of rowID
	index_full = set(data[:, 1])

	# Calculate the number of shapes in the same row
	post = []
	for index in index_full:
		sum = 0
		for i in range(0, len(data)):
			if data[i, 1] == index:
				sum += 1
		post.append([index, sum])
	post = np.array(post)

	# add the row which specifies the number of shape in the same rows
	data = np.hstack((data, np.zeros((np.shape(data)[0], 1))))
	for i in range(0, np.shape(post)[0]):
		for j in range(0, np.shape(data)[0]):
			if post[i,0] == data[j, 1]:
				data[j,2] = post[i, 1]

	# return json file to process in json
	data = data.tolist()
	return json.dumps(data)


def main(argv):
	# Read the image data from argument
	image = cv2.imread(argv[1])
	# Resize if it is necessary(faster but not accurate)
	# resized = imutils.resize(image, width=800)
	# ratio = image.shape[0] / float(resized.shape[0])
	# Make it Gray scale
	gray = cv2.cvtColor(image.copy(), cv2.COLOR_BGR2GRAY)

	# Get the edge by canny effect
	canny = cv2.Canny(gray.copy(), 80,120)

	# Set the kernel for dilation(make the white line thicker)
	kernel = np.ones((3,3),np.uint8)
	dilation = cv2.dilate(canny.copy(),kernel,iterations =7)
	cv2.imwrite("dilate.jpg", dilation)

	# Get the contour from dilated picture, EXTERNAL contour used
	cnts = cv2.findContours(dilation.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_NONE)
	cnts = imutils.grab_contours(cnts)

	# initialize the ShapeDetector class
	sd = ShapeDetector()

	oracle = []
	for c in cnts:
		try:
			# Do if the contourarea is larger than specific area
			if cv2.contourArea(c) > np.shape(image)[0]/40*np.shape(image)[1]/40:

				# Get the moments of the shapes
				M = cv2.moments(c)
				cX = int((M["m10"] / M["m00"]))
				cY = int((M["m01"] / M["m00"]))

				# Detect the shape
				shape = sd.detect(c)

				# Put additional information in the image
				c = c.astype("float")
				c = c.astype("int")
				cv2.drawContours(image, [c], -1, (0, 255, 0), 2)
				cv2.putText(image, shape, (cX, cY), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 0, 255), 2)

				# Store the shape information to oracle
				oracle.append([shape, np.array([cX, cY])])
		except:
			continue

	# Save the image file
	cv2.imwrite("Shape_recognized.jpg", image)
	oracle = np.array(oracle)

	# Create the json file to return the following value to PHP
	# ["Type of shape", "RowID", "number of shape in the same row"]
	jsonfile = get_block(image, oracle, (6,6))
	print(jsonfile)


if __name__ == '__main__':
    main(sys.argv)

