# See
- Companion Site: <http://www.kitebird.com/mysql-cookbook//>

Book is for: MySQL 5.5, 5.6 and 5.7

# mysql Client

## Create User Account

`mysql -h localhost -u root -p`

```sql
CREATE USER 'cbuser'@'localhost' identified BY 'cbpass';
GRANT ALL ON cookbook.* TO 'cbuser'@'localhost';
```


## Create DB and Table

```sql
CREATE DATABASE cookbook;
USE cookbook;
CREATE TABLE limbs (thing varchar(20), legs int, arms int);
INSERT INTO limbs (thing, legs, arms) VALUES('human', 2, 2);
```


# Generating Summary

## Basic

```sql
SELECT count(*) FROM driver_log;

SELECT count(if(dayofweek(trav_date) IN (1,7), 1, NULL)) AS 'weekend trips'
FROM driver_log;

SELECT min(name) AS FIRST,
       max(name) AS LAST,
       min(char_length(name)) AS shortest,
       max(char_length(name)) AS longest
FROM states;

SELECT sum(time_to_sec(t1)) AS 'total seconds' sec_to_time(sum(time_to_sec(t1))) AS 'total time'
FROM time_val;

-- different combination: distinct
SELECT count(DISTINCT srcuser, dstruser)
FROM mail;
```

## Values Associated with Min or Max

Aggregation functions cannot be used in WHERE clause, which require expressions apply to individual rows.

```sql
-- using variable
SET @max = (SELECT max(pop) FROM states);
SELECT pop AS 'highest population', name FROM states WHERE pop=@max;

-- using subquery
SELECT pop AS 'highest population', name FROM states
WHERE pop=(SELECT max(pop) FROM states);

SELECT bname, cnum, vnum, vtext FROM kjv
WHERE char_length(vtext) = (SELECT min(char_length(vtext)) FROM kjv);

-- join on temp tbl
CREATE TEMPORARY TABLE tmp SELECT max(pop) AS maxpop FROM states;
SELECT states.* FROM states INNER JOIN tmp
ON state.pop=tmp.maxpop;
```

## Subgroup Summary

```sql
SELECT srcuser, sum(SIZE) AS 'total bytes',
avg(SIZE) AS 'bytes per messages'
FROM mail GROUP BY srcuser;

SELECT srcuser, srchost, count(srcuser) FROM mail
GROUP BY srcuser, srchost;
```

NOTE: be careful when selectiong nonsummary col not related to grouping col.
When include a group by, the only meaningful value can select are the grouping columns or summary values calced from the group.

```sql
-- WRONG! trav_date may produce wrong result
SELECT name, trav_date, max(mails) AS 'longest trip'
FROM driver_log GROUP BY name;

-- RIGHT
CREATE TEMPORARY TABLE t
    SELECT name, max(miles) AS miles FROM dirver_log GROUP BY name;
SELECT d.name, d.trav_date, d.miles AS 'longest trip'
FROM driver_log AS d INNER JOIN t USING (name, miles) ORDER BY name;
```

## Min or Max of Summary Values

```sql
-- WRONG: agg func's arg cannot be another agg func
SELECT name, sum(miles)
FROM driver_log
GROUP BY name
HAVING sum(miles) = max(sum(miles));

-- RIGHT: But if table has two record both of max, this only shows one
SELECT name, sum(miles)
FROM driver_log
GROUP BY name
ORDER BY sum(miles) DESC LIMIT 1;

-- FIX
SET @max=(SELECT count(*) FROM states
    GROUP BY left(name,1) ORDER BY count(*) DESC LIMIT 1);
SELECT left(name,1) AS letter, count(*) FROM states
GROUP BY letter HAVING count(*)=@max;

SELECT left(name,1) AS letter, count(*) FROM states
GROUP BY letter HAVING count(*) =
(SELECT count(*) FROM states GROUP BY left(name,1) ORDER BY count(*) DESC LIMIT 1);
```


# Using Join and Subquery

select date, ip, count(*) as c
from log as t1
group by date, ip
having count(*) = (
    select count(*) from log
    where date=t1.date
    group by date, ip
    order by count(*) desc limit 1
);