#!/usr/bin/env python2

import MySQLdb as mdb
import cgi
import json

params = cgi.FieldStorage()

if params.has_key('pal_name'):
	pal_name = search.getvalue('pal_name')
else:
	pal_name = ""

if params.has_key('pal_id'):
	pal_id = search.getvalue('pal_id')
else:
	pal_id = ""

print "Content-Type: text/html\n"


connection = mdb.connect('localhost', 'pallet', 'welcome@123', 'pallets')

with connection:

	cur = connection.cursor(mdb.cursors.DictCursor)

	if(!pal_name):
		cur.execute("SELECT pal_name, pal_id, pal_desc FROM pallets WHERE pal_id = " + pal_id)

	elif(!pal_id):
		cur.execute("SELECT pal_name, pal_id, pal_desc FROM pallets WHERE pal_name = " + pal_name)
	else:
		cur.execute("SELECT pal_name, pal_id, pal_desc FROM pallets WHERE pal_name = " + pal_name + " AND pal_id = " + pal_id)

	rows = cur.fetchall()
	
	items = {}

	for row in rows:
		items[row["pal_id"]] = {"pal_name" : row["pal_name"], "pal_id" : row["pal_id"], "pal_desc" : row["pal_desc"]}

	if !len(rows):
		print("No results.")
	else:
		print(json.dumps(items))