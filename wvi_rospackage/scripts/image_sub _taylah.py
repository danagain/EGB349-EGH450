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
    	self.image_pub = rospy.Publisher("/camera/image_raw/compressed_taq", CompressedImage, queue_size=4)
	self.image_string = rospy.Publisher("/taqstring/", String, queue_size=4)

    def callback(self, ros_data):
        '''Callback function of subscribed topic.  Here images get converted and features detected'''
        np_arr = np.fromstring(ros_data.data, np.uint8)
	print("in the call back")
        image_np = cv2.imdecode(np_arr, 1)
	#classifiers = ['cascade.xml','','']
	cc = cv2.CascadeClassifier("cascade.xml")
	#read in image
	image = cv2.imread(image_np)
	# convert to grey
	gray = cv2.cvtCcolor(image_np, cv2.COLOR_BGR2GRAY)
	# run cascade classfier on image
	results = cc.detectMultiscale(gray, 1.05, 3)
	#draw rectangles around each pos result
	for x,y,w,h in results:
		cv2.rectangle(image_np, (x,y), (x+w, y+h), (255,255,0), 3)
	''' INSERT TAQ CODE HERE'''
        #cv2.imshow('cv_img', image_np)
	'''Making a datetime string for the imagename'''
	#date_string = time.strftime("%Y-%m-%d-%H:%M:%S")
	#print(date_string)
        #cv2.imwrite('/usr/local/ampps/www/images/'+date_string+'.jpeg', image_np)
	#imgname = date_string+'.jpeg'
	#cv2.imwrite('/usr/local/ampps/www/images/currentimg/'+date_string+'.jpeg', image_np)
        #cv2.waitKey(2)

	while not rospy.is_shutdown():
        # Try to publish the image
        try:
            #camera.capture('img.jpg') #keep updating the image
    	    #cv_image = cv2.imread('/home/dan/catkin_ws/img.jpg')
	    msg = CompressedImage()
	    msg.header.stamp = rospy.Time.now()
	    msg.format = "jpeg"
	    msg.data = np.array(cv2.imencode('.jpg', image_np)[1]).tostring()
	    image_pub.publish(msg)
            rospy.loginfo("Image sent!")	    
        except CvBridgeError as e:
            print(e)


def main(args):
#init mysql connection
    '''Initializes and cleanup ros node'''
    ic = image_feature()
    rospy.init_node('images_taq', anonymous=True)
    try:
        rospy.spin()
    except KeyboardInterrupt:
        print "Shutting down ROS Image feature detector module"
    cv2.destroyAllWindows()

if __name__ == '__main__':
    main(sys.argv)
