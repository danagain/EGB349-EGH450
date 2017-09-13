#!/usr/bin/env python
# license removed for brevity
import rospy
from std_msgs.msg import String

import roslib
import sys

import cv2
from sensor_msgs.msg import CompressedImage
from cv_bridge import CvBridge, CvBridgeError
import numpy as np
import picamera

def talker():

    # define publisher and topic name
    image_pub = rospy.Publisher("/camera/image_raw/compressed", CompressedImage, queue_size=4)

    # initialize node
    rospy.init_node('image_sender', anonymous=True)
    
    #define cvbridge handler
    bridge = CvBridge();

	#load in an instance of the pi camera library
    camera= picamera.PiCamera()
	#take a picture
    camera.capture('img.jpg')

    #read in file location
    cv_image = cv2.imread('/home/dan/catkin_ws/img.jpg')

    #set node frequency
    rate = rospy.Rate(0.1) #send images at a rate of 0.1 times per second

    while not rospy.is_shutdown():
        # Try to publish the image
        try:
            camera.capture('img.jpg') #keep updating the image
    	    cv_image = cv2.imread('/home/dan/catkin_ws/img.jpg')
	    msg = CompressedImage()
	    msg.header.stamp = rospy.Time.now()
	    msg.format = "jpeg"
	    msg.data = np.array(cv2.imencode('.jpg', cv_image)[1]).tostring()
	    image_pub.publish(msg)
            rospy.loginfo("Image sent!")
	    
        except CvBridgeError as e:
            print(e)

        rate.sleep()

if __name__ == '__main__':
        try:
            talker()
        except rospy.ROSInterruptException:
            pass
			
