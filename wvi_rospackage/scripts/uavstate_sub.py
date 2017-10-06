#!/usr/bin/env python
import roslib;
import rospy
import tf.transformations
import mavros
import MySQLdb
from mavros_msgs.msg import State
import time

counter = 0
db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#globally setup cursor
cursor = db.cursor()


def callback(msg):
    rospy.loginfo("Checking UAV State")
    armed = msg.armed
    rospy.loginfo("UAV State: [ %s ]"%(armed))
    global cursor
    global counter
    counter = counter + 1
    if armed:
    	armed1 = 1
    	cursor.execute("""INSERT INTO uavstate VALUES (%s, %s)""", (armed1, counter))
    	db.commit()
	print("armed")
    else: 
	armed1 = 0
	print("notarmed")
	#cursor.execute("""UPDATE table_name SET armed = 0 WHERE id == 0""")
    	cursor.execute("""INSERT INTO uavstate VALUES (%s, %s)""", (armed1, counter))
    	db.commit()
    time.sleep(1)

def listener():
    rospy.init_node('state_listener', anonymous=True)
    rospy.Subscriber("mavros/state", State, callback)
    rospy.spin()

def initDB():
  global db
  global cursor
#make a fresh table for the data every session
  cursor.execute("DROP TABLE IF EXISTS uavstate")
#remaking the table
  sql = """CREATE TABLE uavstate (
          armed INT,
	  id INT )"""
  cursor.execute(sql)
#creating primary key



if __name__ == '__main__':
    initDB()
    listener()
