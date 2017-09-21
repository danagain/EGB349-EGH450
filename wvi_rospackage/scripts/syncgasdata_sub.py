#!/usr/bin/env python

import rospy
import message_filters
from std_msgs.msg import Int32
import MySQLdb

#global variable to track the id number in the gas readings mysql table
gas_readings_count = 0

def callback(gas_a, gas_b):
  rospy.loginfo("Synced Measurements: [%i, %i]", gas_a.data, gas_b.data)
  global gas_readings_count
  gas_readings_count = gas_readings_count + 1
  cursor.execute("""INSERT INTO gas_readings VALUES (%s, %s, %s)""",(gas_a.data,gas_b.data,gas_readings_count))
  db.commit()
# insert mysql commands herer

if __name__ == '__main__':
  count = 3
  # Initialize
  rospy.init_node('gasdata')

#init mysql connection
  db = MySQLdb.connect("127.0.0.1","root","mysql","UAVDATA" )
#setup cursor
  cursor = db.cursor()
#make a fresh table for the data every session
  cursor.execute("DROP TABLE IF EXISTS gas_readings")
#remaking the table
  sql = """CREATE TABLE gas_readings (
          temp INT,  
          humidity INT,	
	  id INT )"""
  cursor.execute(sql)


  ga_sub = message_filters.Subscriber('/emulator/sensors/gas/a', Int32, queue_size=10)
  gb_sub = message_filters.Subscriber('/emulator/sensors/gas/b', Int32, queue_size=10)
  ts = message_filters.ApproximateTimeSynchronizer([ga_sub, gb_sub], 10, 0.1, allow_headerless=True)
  ts.registerCallback(callback)

  # Loop here until quit
  try:
    rospy.loginfo("Started subscriber node...")
    rospy.spin()
  except rospy.ROSInterruptException:
    # Shutdown
    rospy.loginfo("Shutting down subscriber!")
sp.shutdown()
