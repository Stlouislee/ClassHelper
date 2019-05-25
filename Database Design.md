# Relational Database Schema 



## Schema Design

**-USER**={uid,uname,upasswd} *with minimal key* {uid}

**-COURSE**={crid,cname,cweek_begin,cweek_end,ctime_begin,ctime_end,clocation} *with minimal key* {crid} *and foreign key* {uid,crid}

**-SESSION**={sid,stime} *with minimal key* {sid} *and foreign key* {uid}

**-BOOK**={bid,bname,bpath} *with minimal key* {bid} *and foreign key* {crid}

## Explain the keys

### USER

uid, the id of the user

uname, the name of the user

upasswd, the password of the user, after applying function `md5()`

### COURSE

crid, the id of the course record

cname, the name of the course

cweek_begin, the week the course starts

cweek_end, the week the course ends

ctime_begin, 课程开始的节数

ctime_end, 课程结束的节数

clocation, where the class is held

### SESSION

sid, the session id

stime, the time the session start

### BOOK

bid, the id of the book

bname, the name of the book

bpath, the path of the book in file system



