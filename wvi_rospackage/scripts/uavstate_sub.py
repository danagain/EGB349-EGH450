#!/usr/bin/env python
import roslib;
import rospy
import tf.transformations
import mavros
import MySQLdb
from mavros_msgs.msg import State
import time


db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#globally setup cursor
cursor = db.cursor()


def callback(msg):
    rospy.loginfo("Checking UAV State")
    armed = msg.armed
    rospy.loginfo("UAV State: [ %s ]"%(armed))
    global cursor
    cursor.execute("""INSERT INTO uavstate VALUES (%s)""", (armed))
    db.commit()
    time.sleep(1)

def listener():
    rospy.init_node('state_listener', anonymous=True)
    rospy.Subscriber("mavros_msgs/State", State, callback)
    rospy.spin()

def initDB():
  global db
  global cursor
#make a fresh table for the data every session
  cursor.execute("DROP TABLE IF EXISTS uavstate")
#remaking the table
  sql = """CREATE TABLE uavstate (
          armed BOOL )"""
  cursor.execute(sql)
#creating primary key
  sql2 = """ALTER TABLE uavstate ADD PRIMARY KEY(id)"""
  cursor.execute(sql2)


if __name__ == '__main__':
    initDB()
    listener()
