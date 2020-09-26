# import OPENCV
import cv2

class ShapeDetector:
    # Nothing to initialize
    def __init__(self):
        pass

    # Method to detect the shape
    def detect(self, c):
        # Return "unidentified" if the shape doesn't match any shape
        shape = "unidentified"

        # Approximate the contours by polinomial shape
        peri = cv2.arcLength(c, True)
        approx = cv2.approxPolyDP(c, 0.04 * peri, True)

        # Triangle
        if len(approx) == 3:
            shape = "triangle"

        # Rectangle
        elif len(approx) == 4:
            (x, y, w, h) = cv2.boundingRect(approx)
            por = w / float(h)
            # if the threshold satisfies==> square, if not rectangle
            shape = "square" if por >= 0.6 and por <= 1.4 else "rectangle"

        # Pentagon
        elif len(approx) == 5:
            shape = "pentagon"

        # Hexagon
        elif len(approx) == 6:
            shape = "hexagon"

        # # Septagon
        # elif len(approx) == 7:
        #     shape = "septagon"

        # # Octagon
        # elif len(approx) == 8:
        #     shape = "octagon"

        # if many edges than octagon --> Circle
        else:
            shape = "circle"

        # return the type of the shape
        return shape
