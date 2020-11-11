#!/usr/bin/python

# Import the modules
import cv2
import joblib
from skimage.feature import hog
import numpy as np
import argparse as ap
import imutils
import sys
import math
import json


# Get the path of the training set
parser = ap.ArgumentParser()
parser.add_argument("-c", "--classiferPath", help="Path to Classifier File", required="True")
parser.add_argument("-i", "--image", help="Path to Image", required="True")
args = vars(parser.parse_args())

# Load the classifier
clf, pp = joblib.load(args["classiferPath"])

# Read the input image 
im = cv2.imread(args["image"])

# Convert to grayscale and apply Gaussian filtering
im_gray = cv2.cvtColor(im, cv2.COLOR_BGR2GRAY)
im_gray = cv2.GaussianBlur(im_gray, (5, 5), 0)

# Threshold the image
ret, im_th = cv2.threshold(im_gray, 60, 255, cv2.THRESH_BINARY_INV)

# Find contours in the image
ctrs, hier = cv2.findContours(im_th.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

# Get rectangles contains each contour
rects = [cv2.boundingRect(ctr) for ctr in ctrs]


oracle = []
# For each rectangular region, calculate HOG features and predict
# the digit using Linear SVM.
for rect in rects:
    # Draw the rectangles
    cv2.rectangle(im, (rect[0], rect[1]), (rect[0] + rect[2], rect[1] + rect[3]), (0, 255, 0), 3) 
    # Make the rectangular region around the digit
    leng = int(rect[3] * 1.6)
    pt1 = int(rect[1] + rect[3] // 2 - leng // 2)
    pt2 = int(rect[0] + rect[2] // 2 - leng // 2)
    roi = im_th[pt1:pt1+leng, pt2:pt2+leng]
    # Resize the image
    roi = cv2.resize(roi, (28, 28), interpolation=cv2.INTER_AREA)
    roi = cv2.dilate(roi, (3, 3))
    # Calculate the HOG features
    roi_hog_fd = hog(roi, orientations=9, pixels_per_cell=(14, 14), cells_per_block=(1, 1), visualize=False)
    roi_hog_fd = pp.transform(np.array([roi_hog_fd], 'float64'))
    nbr = clf.predict(roi_hog_fd)
    cv2.putText(im, str(int(nbr[0])), (rect[0], rect[1]),cv2.FONT_HERSHEY_DUPLEX, 2, (0, 255, 255), 3)
    oracle.append([str(int(nbr[0])), np.array([rect[0], rect[1]])])

#print(oracle)
#cv2.namedWindow("Resulting Image with Rectangular ROIs", cv2.WINDOW_NORMAL)
#cv2.imshow("Resulting Image with Rectangular ROIs", im)
#cv2.waitKey()


cv2.imwrite('Shape_recognized.jpg', im)
alsoOracle = oracle
oracle = np.array(oracle)
#print(oracle)
# Create the json file to return the following value to PHP
# ["Type of number", "RowID", "number of shape in the same row"]


# Get the distance of unit
image = im
split = (6,6)

unit_X = np.shape(image)[0] / split[0]
unit_Y = np.shape(image)[1] / split[1]

# Get the row ID and return in data

data = []
for instance in oracle:
    row = math.floor(instance[1][1] / unit_X)
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
        if post[i, 0] == data[j, 1]:
            data[j, 2] = post[i, 1]

# return json file to process in json
print(json.dumps(data.tolist()))

