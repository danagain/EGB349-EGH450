#!/usr/bin/env python
import roslib;
import rospy
import tf.transformations
from geometry_msgs.msg import PoseStamped
import MySQLdb

#global variable to track the id number in the uavloc mysql table
loc_readings_count = 0

db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#globally setup cursor
cursor = db.cursor()



def callback(msg):
    #rospy.loginfo("Received at goal message!")
    #rospy.loginfo("Timestamp: " + str(msg.header.stamp))
    #rospy.loginfo("frame_id: " + str(msg.header.frame_id))

    # Copying for simplicity
    position = msg.pose.position
    quat = msg.pose.orientation
    #rospy.loginfo("Point Position: [ %f, %f, %f ]"%(position.x, position.y, position.z))
    #rospy.loginfo("Quat Orientation: [ %f, %f, %f, %f]"%(quat.x, quat.y, quat.z, quat.w))

    # Also print Roll, Pitch, Yaw
    euler = tf.transformations.euler_from_quaternion([quat.x, quat.y, quat.z, quat.w])
    roll = euler[0]
    pitch = euler[1]
    yaw = euler[2]
    #rospy.loginfo("roll %s pitch %s yaw %s "%str(euler)) 
    #print("roll %s, pitch %s, yaw %s", roll, pitch, yaw) 
    global cursor
    global loc_readings_count
    loc_readings_count = loc_readings_count + 1
    cursor.execute("""INSERT INTO uavloc VALUES (%s, %s, %s, %s, %s, %s, %s)""", (position.x,position.y,position.z,loc_readings_count, roll, pitch, yaw))
    db.commit()

def listener():
    rospy.init_node('goal_listener', anonymous=True)
   # rospy.Subscriber("/mavros/mocap/pose", PoseStamped, callback)
    rospy.Subscriber("/emulator/pose", PoseStamped, callback)
    rospy.spin()

def initDB():
#init mysql connection
  #db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#setup cursor
  global db
  global cursor
#make a fresh table for the data every session
  cursor.execute("DROP TABLE IF EXISTS uavloc")
#remaking the table
  sql = """CREATE TABLE uavloc (
          x FLOAT,  
          y FLOAT,
	  z FLOAT,	
	  id INT,
	  roll FLOAT,
	  pitch FLOAT,
	  yaw FLOAT )"""
  cursor.execute(sql)
#creating primary key
  sql2 = """ALTER TABLE uavloc ADD PRIMARY KEY(id)"""
  cursor.execute(sql2)


if __name__ == '__main__':
    initDB()
    listener()
