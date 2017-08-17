from ldap3 import Server, Connection, ALL_ATTRIBUTES, ALL_OPERATIONAL_ATTRIBUTES, SUBTREE
import getpass

# ****** == change values per case

#server = Server('ldap://******:389') unsecure connection
server = Server('ldaps://******:636')

uname = input ('give user name :: ')
upass = getpass.getpass('give password :: ')


userfilter = '(uid='+uname+')'


conn = Connection(server)
if conn.bind():
    if conn.search("o=*****", "%s"%userfilter, SUBTREE):
        dn = str(conn.entries[0])
        dn = dn[4:]
        dn = dn.split(" ")
        dn = dn[0]
        
        #dn = dn[4:]  #substring to take the needed dn for the 2nd Connection
        #this used to work but the DN had more info .....(after a time period....)
        
        print("%s"%dn)
 
        #2nd Connection with the users credentials to retrieve all info
        conn = Connection(server, "%s"%dn, "%s"%upass)
            
        if conn.bind():
            print("ALL SET")
            if conn.search("o=******", "%s"%userfilter, SUBTREE, attributes=[ALL_ATTRIBUTES, ALL_OPERATIONAL_ATTRIBUTES]):
                print(conn.entries)
            else: print ("OK but no search")
        else:
            print ("NO NOT YET")
       

    else:
        print ('2nd if failed')            
else:
    print('search failed')
