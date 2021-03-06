# Relational Database Schema 



## Schema Design

**-USER**={uid,uname,upasswd} *with minimal key* {uid}

**-COURSE**={crid,cname,cweek_begin,cweek_end,ctime_begin,ctime_end,clocation,cday} *with minimal key* {crid} *and foreign key* {uid}

**-SESSION**={sid,stime} *with minimal key* {sid} *and foreign key* {uid}

**-BOOK**={bid,bname,bpath} *with minimal key* {bid} *and foreign key* {crid}

**-TODO**={tid,task,ddl,done} *with miniaml key* {tid} *and foreign key* {uid}


## Explain the keys

### USER

`uid`, the id of the user

`uname`, the name of the user

`upasswd`, the password of the user, after applying function `md5()`

### COURSE

`crid`, the id of the course record

`cname`, the name of the course

`cweek_begin`, the week the course starts

`cweek_end`, the week the course ends

`ctime_begin`, 课程开始的节数

`ctime_end`, 课程结束的节数

`clocation`, where the class is held

`cday`, the weekday the class be

### SESSION

`sid`, the session id

`stime`, the time the session start

### TODO

`tid`, the task id

`task`, the content of the task

`ddl`, the deadline of the task

`done`, marked 1 if the task is done

`uid`, the id of the user who own this task

### BOOK

`bid`, the id of the book

`bname`, the name of the book

`bpath`, the path of the book in file system



## Create tables on MySQL

### USER

```sql
CREATE TABLE `ClassHelper`.`user` 
( 
    `uid` INT NOT NULL AUTO_INCREMENT , 
    `uname` VARCHAR(255) NOT NULL , 
    `upasswd` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`uid`)
) 
ENGINE = InnoDB;

```



### COURSE

```sql
CREATE TABLE `ClassHelper`.`course` 
( 
    `crid` INT NOT NULL AUTO_INCREMENT , 
    `cname` VARCHAR(255) NOT NULL , 
    `cweek_begin` INT NOT NULL , 
    `cweek_end` INT NOT NULL , 
    `ctime_begin` INT NOT NULL , 
    `ctime_end` INT NOT NULL , 
    `clocation` VARCHAR(255) NOT NULL , 
    `cday` INT NOT NULL , 
    `uid` INT NOT NULL ,
    PRIMARY KEY (`crid`)
) 
ENGINE = InnoDB;
```



### SESSION

```sql
CREATE TABLE `ClassHelper`.`session` 
( 
    `sid` INT NOT NULL , 
    `stime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `uid` INT NOT NULL ,
) 
ENGINE = InnoDB;
```

### FORGOT

```sql
CREATE TABLE `ClassHelper`.`forgot` ( 
  `uid` INT NOT NULL , 
  `resetkey` VARCHAR(255) NOT NULL 
  ) 
ENGINE = InnoDB;
```


### BOOK

```sql
CREATE TABLE `ClassHelper`.`book` 
( 
    `bid` INT NOT NULL AUTO_INCREMENT , 
    `bname` VARCHAR(255) NOT NULL , 
    `bpath` VARCHAR(255) NOT NULL , 
    `cid` INT NOT NULL , 
    PRIMARY KEY (`bid`)
) 
ENGINE = InnoDB;
```

### TODO

```sql
CREATE TABLE `ClassHelper`.`todo` ( 
    `tid` INT NOT NULL AUTO_INCREMENT , 
    `task` VARCHAR(255) NOT NULL , 
    `ddl` DATETIME NOT NULL , 
    `done` INT NOT NULL , 
    'uid' INT NOT NULL,
    PRIMARY KEY (`tid`)
) 
ENGINE = InnoDB;
```

## Adding Foreign Constraints

```sql
ALTER TABLE `book` ADD FOREIGN KEY (`cid`) REFERENCES `course`(`crid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

```sql
ALTER TABLE `course` ADD FOREIGN KEY (`uid`) REFERENCES `user`(`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

```sql
ALTER TABLE `session` ADD FOREIGN KEY (`uid`) REFERENCES `user`(`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```

```sql
ALTER TABLE `forgot` ADD FOREIGN KEY (`uid`) REFERENCES `user`(`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
```
