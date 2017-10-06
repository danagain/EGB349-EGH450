#!/usr/bin/env python
import sys, time
import numpy as np
from scipy.ndimage import filters
import cv2
import roslib
import rospy
from sensor_msgs.msg import CompressedImage
import datetime
import MySQLdb

#global variable to track the id number in the gas readings mysql table
img_readings_count = 0

class image_feature:
    def __init__(self):
        '''Initialize ros publisher, ros subscriber'''

        self.subscriber = rospy.Subscriber("/camera/image_raw/compressed",
                                    CompressedImage, self.callback,  queue_size = 1)

    def callback(self, ros_data):
        '''Callback function of subscribed topic.  Here images get converted and features detected'''
	global img_readings_count
	img_readings_count = img_readings_count + 1
        np_arr = np.fromstring(ros_data.data, np.uint8)
	print("in the call back")
        image_np = cv2.imdecode(np_arr, 1)
        cv2.imshow('cv_img', image_np)
	'''Making a datetime string for the imagename'''
	date_string = time.strftime("%Y-%m-%d-%H:%M:%S")
	print(date_string)
        cv2.imwrite('/usr/local/ampps/www/images/'+date_string+'.jpeg', image_np)
	imgname = date_string+'.jpeg'
	cv2.imwrite('/usr/local/ampps/www/images/currentimg/img.jpeg', image_np)
 	cursor.execute("""INSERT INTO imgnames VALUES (%s, %s)""",(imgname,img_readings_count))
  	db.commit()
        cv2.waitKey(2)

def main(args):
#init mysql connection

    '''Initializes and cleanup ros node'''
    ic = image_feature()
    rospy.init_node('images', anonymous=True)
    try:
        rospy.spin()
    except KeyboardInterrupt:
        print "Shutting down ROS Image feature detector module"
    cv2.destroyAllWindows()

if __name__ == '__main__':
    db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#setup cursor
    cursor = db.cursor()
    cursor.execute("DROP TABLE IF EXISTS imgnames")
#make a fresh table for the data every session
    #cursor.execute("DROP TABLE IF EXISTS imgnames")
#remaking the table
    sql = """CREATE TABLE imgnames (
             image varchar(25),  	
	     id INT )"""
    cursor.execute(sql)
    main(sys.argv)
