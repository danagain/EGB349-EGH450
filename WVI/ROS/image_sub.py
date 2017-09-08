#!/usr/bin/env python
import sys, time
import numpy as np
from scipy.ndimage import filters
import cv2
import roslib
import rospy
from sensor_msgs.msg import CompressedImage
import datetime

class image_feature:
    def __init__(self):
        '''Initialize ros publisher, ros subscriber'''

        self.subscriber = rospy.Subscriber("/camera/image_raw/compressed",
                                    CompressedImage, self.callback,  queue_size = 1)

    def callback(self, ros_data):
        '''Callback function of subscribed topic.  Here images get converted and features detected'''
        np_arr = np.fromstring(ros_data.data, np.uint8)
	print("in the call back")
        image_np = cv2.imdecode(np_arr, 1)

        cv2.imshow('cv_img', image_np)
	'''Making a datetime string for the imagename'''
	date_string = time.strftime("%Y-%m-%d-%H:%M:%S")
	print(date_string)
        cv2.imwrite('images/'+date_string+'.jpeg', image_np)
        cv2.waitKey(2)

def main(args):
    '''Initializes and cleanup ros node'''
    ic = image_feature()
    rospy.init_node('image_feature', anonymous=True)
    try:
        rospy.spin()
    except KeyboardInterrupt:
        print "Shutting down ROS Image feature detector module"
    cv2.destroyAllWindows()

if __name__ == '__main__':
    main(sys.argv)
